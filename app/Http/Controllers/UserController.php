<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserCreated;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $unsortedUsers = User::whereHas('roles', function ($query) {
            return $query->where('name', 'user');
        })->get();

        $users = [
            'awaiting_activation' => [],
            'activated' => []
        ];

        foreach ($unsortedUsers as $user) {
            if ($user->activation_state == User::ACTIVATION_STATE_AWAITING_ACTIVATION) {
                $users['awaiting_activation'][] = $user;
            }

            if ($user->activation_state == User::ACTIVATION_STATE_ACTIVATED) {
                $users['activated'][] = $user;
            }
        }

        return Inertia::render('Users', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $password = Str::random(12);
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('user');
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


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }
}

