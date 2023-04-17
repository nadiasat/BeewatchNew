<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Interventions;
use App\Models\Hive;
use App\Models\InterventionMaterial;

class InterventionMaterialController extends Controller
{

    public function store(Request $request)
    {
        
        //Create the intervention
        $intervention = Interventions::create([
            'hive_id' => $request->hive_id,
            'type' => 'material',
        ]);

        $int_material = InterventionMaterial::create([
            'interventions_id' => $intervention->id,
            'new_rise' => $request->new_rise,
            'new_nb_frames' => $request->new_nb_frames,
        ])->intervention()->associate($intervention);

        $apiary = Hive::find($request->hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }
}
