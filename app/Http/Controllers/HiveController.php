<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apiary;
use App\Models\Hive;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\HoneyJar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Psy\Readline\Hoa\Console;

class HiveController extends Controller
{
    
    //index function show hives of given appiary
    public function index(string $apiary_id)
    {   

        //$hives = $apiary->hives()->get();
        $hives = Hive::where('apiary_id', $apiary_id)->get();

        //get all honey jars
        $honey_jars = HoneyJar::all();

        //dd($hives);
        $hives = $hives->map(function ($hive) {
            return [
                'id' => $hive->id,
                'name' => $hive->name,
                'date_queen' => $hive->date_queen,
                'color_queen' => $hive->color_queen,
                'rise' => $hive->rise,
                'max_nb_frames' => $hive->max_nb_frames,
                'frames_slots' => $hive->frames_slots,
                'nb_varroa' => $hive->nb_varroa,
                'treatment' => $hive->treatment,
                'intensity' => $hive->intensity,
                'food' => $hive->food,
                'is_active' => $hive->is_active,
                'apiary_id' => $hive->apiary_id,
            ];
        });


        return Inertia::render('Hive', [
            'hives' => $hives,
            'apiary_id' => $apiary_id,
            'honey_jars' => $honey_jars,
        ]);
    }


    public function store(Request $request)
    {
        //print $request
        

        $request->validate([
            'name' => 'required|string|max:255',
            //date not obligatory
            'date_queen' => 'nullable|string|max:255',

            //color not obligatory
            'color_queen' => 'nullable|string|max:255',
            //rise boolean default false
            'rise' => 'nullable|boolean',
            'max_nb_frames' => 'required|numeric',
            //nb_frames and nb_varroa numeric not obligatory
            'frames_slots' => 'nullable|string',
            'nb_varroa' => 'nullable|numeric',
        ]);


        $hive = Hive::create([
            'name' => $request->name,
            'date_queen' => $request->date_queen,   
            'color_queen' => $request->color_queen,
            'rise' => $request->rise,
            'max_nb_frames' => $request->max_nb_frames,
            'frames_slots' => $request->frames_slots,
            'nb_varroa' => $request->nb_varroa == null ? 0 : $request->nb_varroa,
            'treatment' => 'none',
            'food' => false,
            //if date is not null, hive is active
            'is_active' => $request->date_queen == null ? false : true,
            'apiary_id' => $request->apiary,
        ]);

        $hive->apiary()->associate($request->apiary);

        if($hive->apiary->inventory_place_id != null) {
            //count difference of frames_slots "c" between hive frame_slots before change and new frames_slots
            $nb_frames = -substr_count($request->frames_slots, 'c');
            //count difference of frames_slots "s" between hive frame_slots before change and new frames_slots
            $nb_separators = -substr_count($request->frames_slots, 's');
            //nb rise is 0 if there is no change in rise, -1 if there is a change from false to true, 1 if there is a change from true to false
            $nb_rise = 0;
            
            if ($hive->rise == true) {
                $nb_rise = -1;
            }

            //dd($nb_frames, $nb_separators, $nb_rise);
            //update inventory place materials
            $result = $this->updateMaterialStock($hive, $nb_frames, $nb_separators, $nb_rise);

            if ($result != "ok") {

                //delete hive if error
                $hive->delete();
                //make a return using intertia such as the error can be caught in the front with onError event
                return redirect()->back()->withErrors(['error' => $result]);
            }
        }
       

        $hive->save();

        $apiary = Apiary::find($request->apiary);
        return redirect()->route('hive', ['apiary' => $apiary]);
    }


    //function to update the hive (name,color_queen)
    public function update(Request $request, int $hive_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            //color not obligatory
            'color_queen' => 'nullable|string|max:255',

        ]);

        $hive = Hive::find($hive_id);

        $hive->name = $request->name;

        if ($request->color_queen != null) {
            $hive->color_queen = $request->color_queen;
        }

        $hive->save();

        return redirect()->route('hive', ['apiary' => $hive->apiary_id]);


    }



    public function updateMaterial(Request $request, int $hive_id)
    {

        $request->validate([
            //rise boolean default false
            'rise' => 'nullable|boolean',
            //nb_frames not obligatory
            'frames_slots' => 'nullable|string'
        ]);

        $hive = Hive::find($hive_id);

        //dd($hive->apiary->inventory_place_id);
        //update inventory place materials
        if($hive->apiary->inventory_place_id != null) {
                    //count difference of frames_slots "c" between hive frame_slots before change and new frames_slots
            $nb_frames = substr_count($hive->frames_slots, 'c') - substr_count($request->frames_slots, 'c');
            //count difference of frames_slots "s" between hive frame_slots before change and new frames_slots
            $nb_separators = substr_count($hive->frames_slots, 's') - substr_count($request->frames_slots, 's');
            //nb rise is 0 if there is no change in rise, -1 if there is a change from false to true, 1 if there is a change from true to false
            $nb_rise = 0;

            if ($hive->rise == false && $request->rise == true) {
                $nb_rise = -1;
            } elseif ($hive->rise == true && $request->rise == false) {
                $nb_rise = 1;
            }

            //dd($nb_frames, $nb_separators, $nb_rise);
            $result = $this->updateMaterialStock($hive, $nb_frames, $nb_separators, $nb_rise);

            if ($result != "ok") {
                //make a return using intertia such as the error can be caught in the front with onError event
                return redirect()->back()->withErrors(['error' => $result]);
            }
        }

        $hive->rise = $request->rise;

        if ($request->frames_slots != null) {
            $hive->frames_slots = $request->frames_slots;
        }

        $hive->save();


        $apiary = Apiary::find($hive->apiary_id);

        //redirect to create intervention material
        return redirect()->route('interventionMaterial.store', 
        ['new_frames_slots' => $request->frames_slots,
        'new_rise' => $request->rise,
        'hive_id' => $hive_id]);
    }

    public function deactivateHive(int $hive_id)
    {
        $hive = Hive::find($hive_id);
        //dd($hive);

        //count number of frames "c" in frames_slots
        $nb_frames = substr_count($hive->frames_slots, 'c');

        $nb_separators = substr_count($hive->frames_slots, 's');

        $nb_rise = 1;


        $hive->is_active = false;
        $hive->date_queen = null;
        $hive->color_queen = null;
        $hive->nb_varroa = 0;
        $hive->intensity = 0;
        $hive->treatment = 'none';
        $hive->food = false;
        $hive->rise = false;
        //frames_slots is reset to all empty slots given max_nb_frames
        $hive->frames_slots = Str::repeat('e,', $hive->max_nb_frames - 1) . 'e';

        $hive->save();


        //dd($hive->inventory_place->materials->where('associated_to', 'frames')->count());

        if($hive->apiary->inventory_place_id != null) {
            //update inventory place materials
            $this->updateMaterialStock($hive, $nb_frames, $nb_separators, $nb_rise);
        }
        

        $apiary = Apiary::find($hive->apiary_id);

        return redirect()->route('interventionQueen.deactivate', 
        ['hive_id' => $hive_id]);
    }

    //add food
    public function addFood(Request $request, int $hive_id, int $apiary_id)
    {
        $hive = Hive::find($hive_id);

        $hive->food = true;

        $food = null;

        //update inventory place materials for food
        if($hive->apiary->inventory_place_id != null) {

            if ($hive->apiary->inventory_place->materials->where('associated_to', 'food')->count() > 0) {

                //get the material associated to frames
                $food = $hive->apiary->inventory_place->materials->where('associated_to', 'food')->first();
                //update the stock of the material
    
                $food->current_stock = $food->current_stock - 1;
    
                //if material is lower than 0 then return error
                if ($food->current_stock < 0) {
    
                    $result = 'Il n\'y a pas assez de nourriture dans le stock';
                    
                    return redirect()->back()->withErrors(['error' => $result]);
    
                } else {
                    $food->save();
                }
                
            }
        }

        $hive->save();

        return redirect()->route('interventionFood.store', 
        ['has_food' => $hive->food,
        'hive_id' => $hive_id]);
    }

    //remove food
    public function removeFood(Request $request, int $hive_id, int $apiary_id)
    {
        $hive = Hive::find($hive_id);

        $hive->food = false;

        $hive->save();

        return redirect()->route('interventionFood.removeFood', 
        ['hive_id' => $hive_id]);
    }

    public function activateHive(Request $request, int $hive_id, int $apiary_id)
    {
        

        $hive = Hive::find($hive_id);


        $request->validate([
            'date_queen' => 'required|date',
            //color not obligatory
            'color_queen' => 'nullable|string|max:255',
            'frames_slots' => 'nullable|string',
            'rise' => 'nullable|boolean',
        ]);

        //dd($hive);

        $hive->is_active = true;
        $hive->date_queen = $request->date_queen;
        $hive->color_queen = $request->color_queen;
        $hive->rise = $request->rise;
        $hive->frames_slots = $request->frames_slots;

        if($hive->apiary->inventory_place_id != null) {
            //count difference of frames_slots "c" between hive frame_slots before change and new frames_slots
            $nb_frames = -substr_count($request->frames_slots, 'c');
            //count difference of frames_slots "s" between hive frame_slots before change and new frames_slots
            $nb_separators = -substr_count($request->frames_slots, 's');
            //nb rise is 0 if there is no change in rise, -1 if there is a change from false to true, 1 if there is a change from true to false
            $nb_rise = 0;

            if ($request->rise == true) {
                $nb_rise = -1;
            }

            //dd($nb_frames, $nb_separators, $nb_rise);
            $result = $this->updateMaterialStock($hive, $nb_frames, $nb_separators, $nb_rise);

            if ($result != "ok") {
                //make a return using intertia such as the error can be caught in the front with onError event
                return redirect()->back()->withErrors(['error' => $result]);
            }
        }


        $hive->save();

        $apiary = Apiary::find($hive->apiary_id);

        return redirect()->route('interventionQueen.store', 
        ['date_queen' => $request->date_queen,
        'color_queen' => $request->color_queen,
        'frames_slots' => $request->frames_slots,
        'rise' => $request->rise,
        'hive_id' => $hive_id]);
    }

    //setTreatment
    public function setTreatment(Request $request, int $hive_id, int $apiary_id)
    {

        
        $hive = Hive::find($hive_id);

        $request->validate([
            'is_active' => 'required|boolean',
            'type' => 'required|string|max:255',
            'intensity' => 'required|numeric',
        ]);

        $hive->treatment = $request->type;
        $hive->intensity = $request->intensity;

        $hive->save();

        //return redirect()->route('hive', ['apiary' => $apiary_id]);

        return redirect()->route('interventionTreatment.store', 
        ['intensity' => $request->intensity,
        'type' => $request->type,
        'is_active' => $request->is_active,
        'hive_id' => $hive_id]);

        //return redirect()->route('interventionTreatment.store');

    }

    public function destroy(Hive $hive, Request $request)
    {
        //update inventory place materials
        if($hive->apiary->inventory_place_id != null) {
            
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
        //dd($request->all());
        $hive->delete();

        return redirect()->route('hive', ['apiary' => $request->id]);
    }

    //private function to update the stock of the material with défault value for rise and food at 0
    private function updateMaterialStock(Hive $hive, int $nb_frames, int $nb_separators, int $nb_rise)
    {

        //dd($nb_frames, $nb_separators, $nb_rise);

        $frames = null;
        $separators = null;
        $rise = null;

        $errors = [];

        //update inventory place materials
        //dd($hive->apiary->inventory_place->materials->where('associated_to', 'frames')->count());
        //if inventory place has materials associated to frames then update the stock of the material
        if ($hive->apiary->inventory_place->materials->where('associated_to', 'frames')->count() > 0) {
            //get the material associated to frames
            $frames = $hive->apiary->inventory_place->materials->where('associated_to', 'frames')->first();
            //update the stock of the material

            $frames->current_stock = $frames->current_stock + $nb_frames;

            //if material is lower than 0 then return error
            if ($frames->current_stock < 0) {

                //add error to errors array
                $errors[] = 'cadres';

            }
            
        }

        //if inventory place has materials associated to separators then update the stock of the material
        if ($hive->apiary->inventory_place->materials->where('associated_to', 'separators')->count() > 0) {
            //get the material associated to frames
            $separators = $hive->apiary->inventory_place->materials->where('associated_to', 'separators')->first();
            //update the stock of the material
            $separators->current_stock = $separators->current_stock + $nb_separators;

            //if material is lower than 0 then return error
            if ($separators->current_stock < 0) {
                
                //add error to errors array
                $errors[] = 'séparateurs';
            }
        }


        if ($nb_rise != 0) {
            //if inventory place has materials associated to rise then update the stock of the material
            if ($hive->apiary->inventory_place->materials->where('associated_to', 'rise')->count() > 0) {
                //get the material associated to frames
                $rise = $hive->apiary->inventory_place->materials->where('associated_to', 'rise')->first();
                //update the stock of the material
                $rise->current_stock = $rise->current_stock + $nb_rise;

                //if material is lower than 0 then return error
                if ($rise->current_stock < 0) {
                    
                    //add error to errors array
                    $errors[] = 'hausses';
                }
            }
        }


        //if errors array is not empty then return error
        if (!empty($errors)) {
            //return error
            return 'Il n\'y a pas assez de ' . implode(', ', $errors) . ' dans le stock';
        } else {
            //save the materials
            if($frames != null) {
                $frames->save();
            }

            if($separators != null) {
                $separators->save();
            }

            if($rise != null) {
                $rise->save();
            }
            return "ok";
        }
        //dd($frames->current_stock, $separators->current_stock, $rise->current_stock);
        
    }


}
