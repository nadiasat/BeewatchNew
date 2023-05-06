<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\InventoryPlace;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        //get all the materials and invertoy placesfrom the database
        $materials = Material::all();
        $inventoryPlaces = InventoryPlace::all();

        //dd($materials->first());

        //Map the materials so that we store them by inventory place in array of arrays
        $materialsByInventoryPlace = $materials->mapToGroups(function ($material, $key) {
            return [$material->inventory_place_id => $material];
        });
        //dd($materialsByInventoryPlace);
        //return the inertia view with the materials by inventory place

        return Inertia::render('InventoryMaterial', [
            'materials' => $materialsByInventoryPlace,
            'inventory_places' => $inventoryPlaces,
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'inventory_place_id' => ['required', 'integer'],
            'current_stock' => ['required', 'integer'],
            'max_stock' => ['required', 'integer'],
        ]);

        //if current stock is geater than max stock return error
        // if ($request->current_stock > $request->max_stock) {
        //     return redirect()->route('inventoryMaterial')->with('error', 'Le sotck actuel ne peut pas être supérieur au stock maximum');
        // }

        Material::create([
            'name' => $request->name,
            'inventory_place_id' => 1,
            'current_stock' => $request->current_stock,
            'max_stock' => $request->max_stock,
        ])->inventory_place()->associate($request->inventory_place_id);

        return redirect()->route('inventoryMaterial');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'inventory_place_id' => ['required', 'integer'],
            'current_stock' => ['required', 'integer'],
            'max_stock' => ['required', 'integer'],
        ]);

        $material = Material::find($request->id);

        //if current stock is geater than max stock return error
        // if ($request->current_stock > $request->max_stock) {
        //     return redirect()->route('inventoryMaterial')->with('error', 'Le sotck actuel ne peut pas être supérieur au stock maximum');
        // }

        $material->update([
            'name' => $request->name,
            'inventory_place_id' => 1,
            'current_stock' => $request->current_stock,
            'max_stock' => $request->max_stock,
        ]);

        $material->save();

        return redirect()->route('inventoryMaterial');
    }

    public function destroy(Material $material)
    {
        //dd($material);
       // $material = Material::find($request->id);

        $material->delete();

        return redirect()->route('inventoryMaterial');
    }
}
