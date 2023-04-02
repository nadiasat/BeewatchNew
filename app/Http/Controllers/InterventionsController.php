<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Interventions;
use App\Models\Hive;

class InterventionsController extends Controller
{
    public function index(Request $request)
    {
        //print in console the interventions
        //dd($request->all());
        $interventions = Hive::find($request->hive_id)->interventions;
        //dd($interventions);
        //return intertia render of intervention
        return Inertia::render('HiveDetails', [
            'interventions' => $interventions,
            'hive_id' => $request->hive_id,
            'hive_name' => $request->hive_name,
        ]);

    }

    public function store(Request $request, int $hive_id)
    {

        Interventions::create(
            $request->all()
        );

        $apiary = Hive::find($hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }
}
