<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apiary;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;



class ApiaryController extends Controller
{
    public function index()
    {
       
        $apiaries = User::find(Auth::user()->id)->apiaries()->get();

        $apiaries_hives = [];
    
        // Link inactive and active hives to apiaries
        foreach ($apiaries as $apiary) {
            $apiaries_hives[] = [
                'id' => $apiary->id,
                'name' => $apiary->name,
                'address' => $apiary->address,
                'nb_active_hives' => $apiary->hives()->where('is_active', true)->count(),
                'nb_inactive_hives' => $apiary->hives()->where('is_active', false)->count(),
            ];
        }
        

        return Inertia::render('Apiary', [
            'apiaries' => $apiaries_hives
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

    public function updateApiary(Request $request, Apiary $apiary)
    {
        
        // validate resquest values
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        //modify the apiary name and address with the request values
        $apiary->name = $request->name;
        $apiary->address = $request->address;

        //save the apiary
        $apiary->save();


        return redirect()->route('apiary');



    }

    public function destroy(Apiary $apiary)
    {    
        
        //detach all users from the apiary
        $apiary->users()->detach();

        //soft delete the apiary
        $apiary->delete();

        return redirect()->route('apiary');
    }

    

}
