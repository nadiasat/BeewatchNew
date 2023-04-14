<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Interventions;
use App\Models\Hive;
use App\Models\InterventionQueen;

class InterventionQueenController extends Controller
{
    
    public function store(Request $request)
    {
        
        //Create the intervention
        $intervention = Interventions::create([
            'hive_id' => $request->hive_id,
            'type' => 'new_queen',
        ]);

        $int_queen = InterventionQueen::create([
            'interventions_id' => $intervention->id,
            'date_queen' => $request->date_queen,
            'color_queen' => $request->color_queen,
            'rise' => $request->rise,
            'nb_frames' => $request->nb_frames,
        ])->intervention()->associate($intervention);

        $apiary = Hive::find($request->hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }

    public function deactivate(Request $request)
    {
        $intervention = Interventions::create([
            'hive_id' => $request->hive_id,
            'type' => 'remove_queen',
        ]);

        $apiary = Hive::find($request->hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }
}
