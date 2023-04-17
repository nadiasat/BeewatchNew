<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Apiary;
use App\Models\Interventions;
use App\Models\Hive;
use Illuminate\Support\Facades\App;

class InterventionsController extends Controller
{
    public function index(Request $request)
    {
        //print in console the intervention
        //get all interventions of the hive ordered by date
        $hive = Hive::find($request->hive_id);
        //dd($hive);
        $apiary = Apiary::find($hive->apiary_id);

        $interventions = $hive->interventions()->orderBy('created_at', 'desc')->get();

        //foreach intervention store in details field the 
        foreach ($interventions as $intervention) {
            switch ($intervention->type) {
                case 'control':
                    $intervention->details = $intervention->intervention_control;
                    break;

                case 'material':
                    $intervention->details = $intervention->intervention_material;
                    break;

                case 'new_queen':
                    $intervention->details = $intervention->intervention_new_queen;
                    break;

                case 'remove_queen':
                    $intervention->details = $intervention->intervention_remove_queen;
                    break;

                case 'treatment':
                    $intervention->details = $intervention->intervention_treatment;
                    break;
            }
        }


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
            'hive' => $hive,
            'apiary' => $apiary,
            'previousRoute' => url()->previous(),
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
