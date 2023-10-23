<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Interventions;
use App\Models\Hive;
use App\Models\InterventionTreatment;

class InterventionTreatmentController extends Controller
{
    public function store(Request $request)
    {

        $intervention = Interventions::create([
            'hive_id' => $request->hive_id,
            'type' => 'treatment',
        ]);

        $int_treatment = InterventionTreatment::create([
            'interventions_id' => $intervention->id,
            'is_active' => $request->is_active,
            'type' => $request->type,
            'intensity' => $request->intensity,
            
        ])->intervention()->associate($intervention);

        $apiary = Hive::find($request->hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }
}
