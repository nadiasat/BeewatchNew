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
        //get all interventions of the hive ordered by date
        $interventions = Hive::find($request->hive_id)->interventions()->orderBy('created_at', 'desc')->get();

        //array of all dates and nb varoas of the hive on each control interventio
        $record_nb_varroa = [];

        //for each intervention
        foreach ($interventions as $intervention) {
            //if the intervention is a control intervention
            if ($intervention->type == 'control') {
                //get the nb varroa of the intervention
                $nb_varroa = $intervention->intervention_control->nb_varroa;
                //get the date of the intervention
                $date = $intervention->created_at->format('d/m/Y');
                //add the date and the nb varroa to the array
                $record_nb_varroa[] = ['date' => $date, 'nb_varroa' => $nb_varroa];
            }
        }

        //invert the array to have the last nb varroa at the first position
        $record_nb_varroa = array_reverse($record_nb_varroa);

        //dd($interventions);
        //return intertia render of intervention
        return Inertia::render('HiveDetails', [
            'interventions' => $interventions,
            'record_nb_varroa' => $record_nb_varroa,
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
