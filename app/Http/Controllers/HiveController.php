<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apiary;
use App\Models\Hive;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class HiveController extends Controller
{
    
    //index function show hives of given appiary
    public function index(Apiary $apiary)
    {
        $hives = $apiary->hives()->get();

        $hives = $hives->map(function ($hive) {
            return [
                'id' => $hive->id,
                'name' => $hive->name,
                'date_queen' => $hive->date_queen,
                'rise' => $hive->rise,
                'nb_frames' => $hive->nb_frames,
                'nb_varroa' => $hive->nb_varroa,
                'active' => $hive->is_active,
                'apiary_id' => $hive->apiary_id,
            ];
        });

        return Inertia::render('Hive', [
            'hives' => $hives
        ]);
    }
    // public function index()
    // {
    //     $hives = Auth::user()->hives->get();

    //     $hives = $hives->map(function ($hive) {
    //         return [
    //             'id' => $hive->id,
    //             'name' => $hive->name,
    //             'active' => $hive->active,
    //             'apiary_id' => $hive->apiary_id,
    //             'apiary_name' => $hive->apiary->name,
    //         ];
    //     });

    //     return Inertia::render('Hive', [
    //         'hives' => $hives
    //     ]);
    // }


    public function store(Request $request)
    {
        //print $request
        print_r($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'date_queen' => 'required|date',
            'rise' => 'required|numeric',
            'nb_frames' => 'required|numeric',
            'nb_varroa' => 'required|numeric',
            'active' => 'required|boolean',
            'apiary_id' => 'required|numeric',
        ]);

        $hive = Hive::create([
            'name' => $request->name,
            'date_queen' => $request->date_queen,
            'rise' => $request->rise,
            'nb_frames' => $request->nb_frames,
            'nb_varroa' => $request->nb_varroa,
            'active' => $request->active,
            'apiary_id' => $request->apiary_id,
        ]);

        $hive->users()->attach(Auth::user()->id);

        $hive->save();

        return redirect()->route('hive');
    }

    public function destroy(Hive $hive)
    {
        $hive->delete();

        return redirect()->route('hive');
    }


}
