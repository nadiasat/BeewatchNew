<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HoneyJar;
use App\Models\User;
use Inertia\Inertia;

class HoneyJarController extends Controller
{
    public function index()
    {
        $honeyjars = HoneyJar::all();

        $records = [];

        $users = User::all();

        //Foreach honeyjar, get the pivot table to get the number of jars for each user
        foreach ($honeyjars as $honeyjar) {

            foreach ($honeyjar->users as $user) {
                $records[] = [
                    'size' => $honeyjar->size,
                    'nb_jar' => $user->pivot->nb_jar,
                    'user_name' => $user->lastname . ' ' . $user->firstname,
                    'created_at' => $user->pivot->created_at,
                ];
            }
            
        }
        

        $honeyjars = $honeyjars->map(function ($honeyjar) {
            return [
                'id' => $honeyjar->id,
                'size' => $honeyjar->size,
                'nb_jar' => $honeyjar->nb_jar,
            ];
        });

        //dd($honeyjars);

        return Inertia::render('InventoryHoney', [
            'honey_jars' => $honeyjars,
            'records' => $records,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        //print $request
        print_r($request->all());

        $request->validate([
            'size' => 'required|string|max:255',
            'nb_jar' => 'required|numeric',
        ]);

        $honeyjar = HoneyJar::create([
            'size' => $request->size,
            'nb_jar' => $request->nb_jar,
        ]);

        return redirect()->route('inventoryHoney');
    }

    public function destroy(HoneyJar $honey_jar)
    {
        $honey_jar->delete();

        return redirect()->route('inventoryHoney');
    }

    public function createRecord(Request $request) {
        $request->validate([
            'user' => 'required|numeric',
            'jar' => 'required|numeric',
            'nb_jar' => 'required|numeric',
        ]);
        


        //get jar
        $honey_jar = HoneyJar::find($request->jar);

        //update nb_jar in honey_jar table where current nb_jar - nb_jar in request
        //if nb_jar is negative, return error
        if ($honey_jar->nb_jar - $request->nb_jar < 0) {
            return redirect()->route('inventoryHoney');
        } else {
            $honey_jar->update([
                'nb_jar' => $honey_jar->nb_jar - $request->nb_jar,
            ]);
        }

        $user = User::find($request->user);
        //if date is null, set it to now
        if ($request->created_at == null) {
            $request->created_at = now();
        }

        //dd($request->all());

        //attach user to honey_jar with nb_jar
        $honey_jar->users()->attach($user, ['nb_jar' => $request->nb_jar, 'created_at' => $request->created_at]);

        return redirect()->route('inventoryHoney');
    }

    public function update(Request $request, HoneyJar $honey_jar)
    {
        $request->validate([
            'nb_jar' => 'required|numeric',
        ]);

        $honey_jar->update([
            'nb_jar' => $request->nb_jar,
        ]);

        return redirect()->route('inventoryHoney');
    }
}
