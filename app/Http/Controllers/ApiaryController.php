<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apiary;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;


class ApiaryController extends Controller
{
    public function index()
    {
        //return view('apiary');
        // show apiaries for current user
        $apiaries = Auth::user()->apiaries()->get();
        return Inertia::render('Apiary', [
            'apiaries' => $apiaries
        ]);

        
    }

    public function store(Request $request)
    {
        //print $request
        print_r($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $apiary = Apiary::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        $apiary->users()->attach(Auth::user()->id);

        $apiary->save();

        return redirect()->route('apiary');
    }


}
