<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InventoryMaterial;
use Inertia\Inertia;



class InventoryMaterialController extends Controller
{
   public function index()
    {
        //inventoryMaterial = InventoryMaterial::all();

         return Inertia::render('InventoryMaterial', [
                'inventoryMaterial' => "test"
          ]);
    }

    public function store(Request $request)
    {
        //print $request
        
    }



    

}
