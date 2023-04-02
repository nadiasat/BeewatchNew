<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Interventions;
use App\Models\Hive;
use App\Models\InterventionControl;

class InterventionControlController extends Controller
{
    public function store(Request $request)
    {
        //Create the intervention
        $intervention = Interventions::create([
            'hive_id' => $request->hive_id,
            'type' => 'control',
        ]);

        $int_queen = InterventionControl::create([
            'intervention_id' => $intervention->id,
            'glimpse_queen' => $request->glimpse_queen,
            'queen_laid' => $request->queen_laid,
            'brood' => $request->brood,
            'frames_full' => $request->frames_full,
            'honey' => $request->honey,
            'honey_rise' => $request->honey_rise,
            'comment' => $request->comment,
        ]);

        $apiary = Hive::find($request->hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }
}
