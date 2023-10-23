<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Interventions;
use App\Models\Hive;
use App\Models\InterventionFood;

class InterventionFoodController extends Controller
{
    public function store(Request $request)
    {
        //print $request
        $intervention = Interventions::create([
            'hive_id' => $request->hive_id,
            'type' => 'add_food',
        ]);

        $int_food = InterventionFood::create([
            'interventions_id' => $intervention->id,
            'has_food' => $request->has_food,
        ])->intervention()->associate($intervention);

        $apiary = Hive::find($request->hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }

    //fucntion removeFood
    public function removeFood(Request $request)
    {
        //print $request
        $intervention = Interventions::create([
            'hive_id' => $request->hive_id,
            'type' => 'remove_food',
        ]);

        $apiary = Hive::find($request->hive_id)->apiary_id;

        return redirect()->route('hive', ['apiary' => $apiary]);
    }
}
