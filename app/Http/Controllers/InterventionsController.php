<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Interventions;
use App\Models\Hive;

class InterventionsController extends Controller
{
    public function index()
    {
        return Inertia::render('Interventions');
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
