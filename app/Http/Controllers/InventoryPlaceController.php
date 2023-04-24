<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\InventoryPlace;
use Inertia\Inertia;
use Illuminate\Http\Request;

class InventoryPlaceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        InventoryPlace::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('inventoryMaterial');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $inventory_place = InventoryPlace::find($request->id);

        $inventory_place->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        $inventory_place->save();

        return redirect()->route('inventoryMaterial');
    }

    public function destroy(Request $request)
    {
        //dd($request->all());
        $inventory_place = InventoryPlace::find($request->id);

        $inventory_place->delete();

        return redirect()->route('inventoryMaterial');
    }
    
}
