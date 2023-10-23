<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apiary;
use App\Models\InventoryPlace;
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
        
        //get all inventory places
        $inventory_places = InventoryPlace::all();


        $apiaries_hives = [];
    
        // Link inactive and active hives to apiaries
        foreach ($apiaries as $apiary) {
            $apiaries_hives[] = [
                'id' => $apiary->id,
                'name' => $apiary->name,
                'address' => $apiary->address,
                'inventory_place_id' => $apiary->inventory_place_id,
                'nb_active_hives' => $apiary->hives()->where('is_active', true)->count(),
                'nb_inactive_hives' => $apiary->hives()->where('is_active', false)->count(),
            ];
        }
        

        return Inertia::render('Apiary', [
            'apiaries' => $apiaries_hives,
            'inventory_places' => $inventory_places,
        ]);



    }

    public function store(Request $request)
    {
        //print $request

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $apiary = Apiary::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);



        if($request->inventory_place_id != null){

            $apiary->inventory_place()->associate($request->inventory_place_id);
        }

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

        //if inventory place has changed
        if($request->inventory_place_id != $apiary->inventory_place_id){

            $old_place_frames = null;
            $old_place_separators = null;
            $old_place_rise = null;

            $old_place_old_frames = null;
            $old_place_old_separators = null;
            $old_place_old_rise = null;

            $new_place_frames = null;
            $new_place_separators = null;
            $new_place_rise = null;

            $new_place_old_frames = null;
            $new_place_old_separators = null;
            $new_place_old_rise = null;

            $errors = [];


            if($apiary->inventory_place_id != null) {

                //get the old inventory place materials associated to frames, separators and rise
                $old_place_old_frames = $apiary->inventory_place->materials->where('associated_to', 'frames')->first();
                $old_place_old_separators = $apiary->inventory_place->materials->where('associated_to', 'separators')->first();
                $old_place_old_rise = $apiary->inventory_place->materials->where('associated_to', 'rise')->first();

                //for each hive in the apiary update stock to add material used in previous inventory place
                foreach ($apiary->hives as $hive) {
                
                        $nb_frames = substr_count($hive->frames_slots, 'c');
                        //count difference of frames_slots "s" between hive frame_slots before change and new frames_slots
                        $nb_separators = substr_count($hive->frames_slots, 's');
                        //nb rise is 0 if there is no change in rise, -1 if there is a change from false to true, 1 if there is a change from true to false
                        $nb_rise = 0;
                        
                        if ($hive->rise == true) {
                            $nb_rise = 1;
                        }


                        if ($hive->apiary->inventory_place->materials->where('associated_to', 'frames')->count() > 0) {
                            
                            //get the material associated to frames

                            $old_place_frames = $hive->apiary->inventory_place->materials->where('associated_to', 'frames')->first();

                            //update the stock of the material
                            $old_place_frames->current_stock = $old_place_frames->current_stock + $nb_frames;
                
                            if ($old_place_frames->current_stock > $old_place_frames->max_stock) {
                
                                //set max stock to current stock
                                $old_place_frames->max_stock = $old_place_frames->current_stock;
                            }

                            $old_place_frames->save();

                            
                        }

                        //if inventory place has materials associated to separators then update the stock of the material
                        if ($hive->apiary->inventory_place->materials->where('associated_to', 'separators')->count() > 0) {
                            //get the material associated to frames
                            $old_place_separators = $hive->apiary->inventory_place->materials->where('associated_to', 'separators')->first();
                            //update the stock of the material
                            $old_place_separators->current_stock = $old_place_separators->current_stock + $nb_separators;

                            if ($old_place_separators->current_stock > $old_place_separators->max_stock) {
                
                                //set max stock to current stock
                                $old_place_separators->max_stock = $old_place_separators->current_stock;
                            }

                            $old_place_separators->save();

                        }


                        if ($nb_rise != 0) {
                            //if inventory place has materials associated to rise then update the stock of the material
                            if ($hive->apiary->inventory_place->materials->where('associated_to', 'rise')->count() > 0) {
                                //get the material associated to frames
                                $old_place_rise = $hive->apiary->inventory_place->materials->where('associated_to', 'rise')->first();
                                //update the stock of the material
                                $old_place_rise->current_stock = $old_place_rise->current_stock + $nb_rise;

                                if ($old_place_rise->current_stock > $old_place_rise->max_stock) {
                
                                    //set max stock to current stock
                                    $old_place_rise->max_stock = $old_place_rise->current_stock;
                                }

                                $old_place_rise->save();


                            }
                        }

                }
            }

            

            $old_inventory_place_id = $apiary->inventory_place_id;

            //attach the new inventory place
            $apiary->inventory_place()->associate($request->inventory_place_id);

            $apiary->save();

            $apiary->refresh();


            //if the new inventory place is not null then update the stock of the material to remove material used in new inventory place
            if($request->inventory_place_id != null) {

                $new_place_old_frames = $apiary->inventory_place->materials->where('associated_to', 'frames')->first();
                $new_place_old_separators = $apiary->inventory_place->materials->where('associated_to', 'separators')->first();
                $new_place_old_rise = $apiary->inventory_place->materials->where('associated_to', 'rise')->first();

                //for each hive in the apiary update stock to remove material used in new inventory place
                foreach ($apiary->hives as $hive) {

                    // dd($apiary->id,
                    //     $apiary->inventory_place_id,
                    //     $hive->apiary->id,
                    //     $hive->apiary->inventory_place_id);
                
                    $nb_frames = -substr_count($hive->frames_slots, 'c');
                    //count difference of frames_slots "s" between hive frame_slots before change and new frames_slots
                    $nb_separators = -substr_count($hive->frames_slots, 's');
                    //nb rise is 0 if there is no change in rise, -1 if there is a change from false to true, 1 if there is a change from true to false
                    $nb_rise = 0;
                    
                    if ($hive->rise == true) {
                        $nb_rise = -1;
                    }

                    //dd($nb_frames, $nb_separators, $nb_rise);

                    //update inventory place materials
                    //dd($hive->apiary->inventory_place->materials->where('associated_to', 'frames')->count());
                    //if inventory place has materials associated to frames then update the stock of the material
                    if ($hive->apiary->inventory_place->materials->where('associated_to', 'frames')->count() > 0) {

                        //get the material associated to frames
                        $new_place_frames = $hive->apiary->inventory_place->materials->where('associated_to', 'frames')->first();
                        //update the stock of the material

                        $new_place_frames->current_stock = $new_place_frames->current_stock + $nb_frames;

                        //if material is lower than 0 then return error
                        if ($new_place_frames->current_stock < 0) {

                            //add error to errors array
                            $errors[] = 'cadres';

                        }
                        
                    }

                    //if inventory place has materials associated to separators then update the stock of the material
                    if ($hive->apiary->inventory_place->materials->where('associated_to', 'separators')->count() > 0) {
                        //get the material associated to frames
                        $new_place_separators = $hive->apiary->inventory_place->materials->where('associated_to', 'separators')->first();
                        //update the stock of the material
                        $new_place_separators->current_stock = $new_place_separators->current_stock + $nb_separators;

                        //if material is lower than 0 then return error
                        if ($new_place_separators->current_stock < 0) {
                            
                            //add error to errors array
                            $errors[] = 'séparateurs';
                        }
                    }


                    if ($nb_rise != 0) {
                        //if inventory place has materials associated to rise then update the stock of the material
                        if ($hive->apiary->inventory_place->materials->where('associated_to', 'rise')->count() > 0) {
                            //get the material associated to frames
                            $new_place_rise = $hive->apiary->inventory_place->materials->where('associated_to', 'rise')->first();
                            //update the stock of the material
                            $new_place_rise->current_stock = $new_place_rise->current_stock + $nb_rise;

                            //if material is lower than 0 then return error
                            if ($new_place_rise->current_stock < 0) {
                                
                                //add error to errors array
                                $errors[] = 'hausses';
                            }
                        }
                    }
                    

                    if (!empty($errors)) {
                        //return error
                        $result = 'Il n\'y a pas assez de ' . implode(', ', $errors) . ' dans le stock';

                        //revert the changes for the associated inventory place on the apiary
                        $apiary->inventory_place()->associate($old_inventory_place_id);

                        $apiary->save();

                        
                        // dd($old_place_frames, $old_place_separators, $old_place_rise, 
                        //     $old_place_old_frames, $old_place_old_separators, $old_place_old_rise,
                        //     $new_place_frames, $new_place_separators, $new_place_rise,
                        //     $new_place_old_frames, $new_place_old_separators, $new_place_old_rise);

                        //reset the changes for the old inventory place
                        if($old_place_old_frames != null && $old_place_frames != null) {

                            $old_place_frames->current_stock = $old_place_old_frames->current_stock;
                            $old_place_frames->max_stock = $old_place_old_frames->max_stock;
                            $old_place_frames->save();
                        }

                        if($old_place_old_separators != null && $old_place_separators != null) {

                            $old_place_separators->current_stock = $old_place_old_separators->current_stock;
                            $old_place_separators->max_stock = $old_place_old_separators->max_stock;
                            $old_place_separators->save();
                        }

                        if($old_place_old_rise != null && $old_place_rise != null) {

                            $old_place_rise->current_stock = $old_place_old_rise->current_stock;
                            $old_place_rise->max_stock = $old_place_old_rise->max_stock;
                            $old_place_rise->save();
                        }



                        //reset the changes for the new inventory place
                        if($new_place_old_frames != null && $new_place_frames != null) {

                            $new_place_frames->current_stock = $new_place_old_frames->current_stock;
                            $new_place_frames->save();
                        }

                        if($new_place_old_separators != null && $new_place_separators != null) {

                            $new_place_separators->current_stock = $new_place_old_separators->current_stock;
                            $new_place_separators->save();
                        }

                        if($new_place_old_rise != null && $new_place_rise != null) {

                            $new_place_rise->current_stock = $new_place_old_rise->current_stock;
                            $new_place_rise->save();
                        }
                        
                        return redirect()->back()->withErrors(['error' => $result]);

                    } else {
                        //save the materials
                        if($new_place_frames != null) {
                            $new_place_frames->save();
                        }
        
                        if($new_place_separators != null) {
                            $new_place_separators->save();
                        }

                        if($new_place_rise != null) {
                            $new_place_rise->save();
                        }
                    }
                
                }
            }

            

        }

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
