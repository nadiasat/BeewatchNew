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
use Psy\Readline\Hoa\Console;

class HiveController extends Controller
{
    
    //index function show hives of given appiary
    public function index(string $apiary_id)
    {   

        //$hives = $apiary->hives()->get();
        $hives = Hive::where('apiary_id', $apiary_id)->get();

        $hives = $hives->map(function ($hive) {
            return [
                'id' => $hive->id,
                'name' => $hive->name,
                'date_queen' => $hive->date_queen,
                'color_queen' => $hive->color_queen,
                'rise' => $hive->rise,
                'nb_frames' => $hive->nb_frames,
                'nb_varroa' => $hive->nb_varroa,
                'is_active' => $hive->is_active,
                'apiary_id' => $hive->apiary_id,
            ];
        });

        return Inertia::render('Hive', [
            'hives' => $hives,
            'apiary_id' => $apiary_id,
        ]);
    }


    public function store(Request $request)
    {
        //print $request
        print_r($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            //date not obligatory
            'date_queen' => 'nullable|date',

            //color not obligatory
            'color_queen' => 'nullable|string|max:255',
            //rise boolean default false
            'rise' => 'nullable|boolean',
            //nb_frames and nb_varroa numeric not obligatory
            'nb_frames' => 'nullable|numeric',
            'nb_varroa' => 'nullable|numeric',
        ]);

        $hive = Hive::create([
            'name' => $request->name,
            'date_queen' => $request->date_queen,
            'color_queen' => $request->color_queen,
            'rise' => $request->rise,
            'nb_frames' => $request->nb_frames == null ? 0 : $request->nb_frames,
            'nb_varroa' => $request->nb_varroa == null ? 0 : $request->nb_varroa,
            //if date is not null, hive is active
            'is_active' => $request->date_queen == null ? false : true,
            'apiary_id' => $request->apiary,
        ]);

        $hive->apiary()->associate($request->apiary);

        $hive->save();

        $apiary = Apiary::find($request->apiary);
        return redirect()->route('hive', ['apiary' => $apiary]);
    }

    public function updateMaterial(Request $request, int $hive_id)
    {
        $request->validate([
            //rise boolean default false
            'rise' => 'nullable|boolean',
            //nb_frames not obligatory
            'nb_frames' => 'nullable|numeric'
        ]);

        $hive = Hive::find($hive_id);

        $hive->rise = $request->rise;

        if ($request->nb_frames != null) {
            $hive->nb_frames = $request->nb_frames;
        }

        $hive->save();

        $apiary = Apiary::find($hive->apiary_id);

        //redirect to create intervention material
        return redirect()->route('interventionMaterial.store', 
        ['new_nb_frames' => $request->nb_frames,
        'new_rise' => $request->rise,
        'hive_id' => $hive_id]);
    }

    public function deactivateHive(int $hive_id)
    {
        $hive = Hive::find($hive_id);

        $hive->is_active = false;
        $hive->date_queen = null;
        $hive->color_queen = null;
        $hive->nb_varroa = 0;
        $hive->rise = false;
        $hive->nb_frames = 0;

        $hive->save();

        $apiary = Apiary::find($hive->apiary_id);

        return redirect()->route('interventionQueen.deactivate', 
        ['hive_id' => $hive_id]);
    }


    public function activateHive(Request $request, int $hive_id)
    {
        $hive = Hive::find($hive_id);

        $request->validate([
            'date_queen' => 'required|date',
            'color_queen' => 'required|string|max:255',
            'nb_frames' => 'nullable|numeric',
            'rise' => 'nullable|boolean',
        ]);

        $hive->is_active = true;
        $hive->date_queen = $request->date_queen;
        $hive->color_queen = $request->color_queen;
        $hive->rise = $request->rise;
        $hive->nb_frames = $request->nb_frames == null ? 0 : $request->nb_frames;


        $hive->save();

        $apiary = Apiary::find($hive->apiary_id);

        return redirect()->route('interventionQueen.store', 
        ['date_queen' => $request->date_queen,
        'color_queen' => $request->color_queen,
        'nb_frames' => $request->nb_frames,
        'rise' => $request->rise,
        'hive_id' => $hive_id]);
    }

    public function destroy(Hive $hive)
    {
        $hive->delete();

        return redirect()->route('hive');
    }


}
