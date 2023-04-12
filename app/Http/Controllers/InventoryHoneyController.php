<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InventoryHoney;
use Inertia\Inertia;



class InventoryHoneyController extends Controller
{
   public function index()
    {
        //inventoryHoney = InventoryHoney::all();

       return Inertia::render('InventoryHoney', [
            'inventoryHoney' => "test"
        ]);
    }

    public function store(Request $request)
    {
        //print $request
        
    }



    

}
