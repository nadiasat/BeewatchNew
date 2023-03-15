<?php

namespace App\Http\Controllers;

use App\Models\Apiary;
use App\Models\User;
use App\Notifications\UserCreated;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use LDAP\Result;

class UserController extends Controller
{
    public function index()
    {
        //join user role table and sort by activation state take only 
        //admins and users also join apiaries ids
        $unsortedUsers = User::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('users.*', 'roles.name as role')
        ->orderBy('activation_state', 'asc')
        ->get();

        $users = [
            'awaiting_activation' => [],
            'activated' => []
        ];

        foreach ($unsortedUsers as $user) {
            $userApiaries = Apiary::join('apiary_user', 'apiary_user.apiary_id', '=', 'apiaries.id')
            ->select('apiaries.id', 'apiaries.name')
            ->where('apiary_user.user_id', $user->id)
            ->get();

            #store apiaries in user object
            $user->apiaries = $userApiaries;

            
            if ($user->activation_state == User::ACTIVATION_STATE_AWAITING_ACTIVATION) {
                $users['awaiting_activation'][] = $user;
            }

            if ($user->activation_state == User::ACTIVATION_STATE_ACTIVATED) {
                $users['activated'][] = $user;
            }
        }

        #Get appiaries linked to users
        $apiaries = Apiary::all();


        return Inertia::render('Users', [
            'users' => $users,
            'apiaries' => $apiaries,
        ]);
    }

    public function store(Request $request)
    {
        //print $request
        print_r($request->all());

        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);



        $password = Str::random(12);
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($password),
            'activation_state' => User::ACTIVATION_STATE_AWAITING_ACTIVATION,
        ]);

        $user->assignRole($request->role);
        $user->notify(new UserCreated($password));

        return redirect()->route('users');
    }

    public function showAccountActivationForm()
    {
        return Inertia::render('Auth/AccountActivation');
    }

    public function activateAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->activation_state = User::ACTIVATION_STATE_ACTIVATED;
        $user->save();

        return redirect()->route('dashboard');
    }


    public function updateUser(Request $request, User $user)
    {
        //get only ids from apiaries
        $request->apiaries = array_map(function ($apiary) {
            return $apiary['id'];
        }, $request->apiaries);
        //SYNC APIARIES ids WITH USER
        $user->apiaries()->sync($request->apiaries);
        $user->syncRoles($request->role);

        return redirect()->route('users');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }
}

