<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HoneyJar;
use App\Models\Hive;
use App\Models\Apiary;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use PHPUnit\Runner\Hook;
use Termwind\Components\Dd;

class HoneyJarController extends Controller
{
    public function index()
    {
        //$honeyjars = HoneyJar::all();
        // GET ALL HONEY JARS EVEN DELETED ONES
        $honeyjars = HoneyJar::withTrashed()->get();

        $records = [];

        $users = User::all();

        //Foreach honeyjar, get the pivot table to get the number of jars for each user
        foreach ($honeyjars as $honeyjar) {
            //get the records of honeyjar where other_person is not null

            foreach ($honeyjar->users as $user) {
                $records[] = [
                    'size' => $honeyjar->size,
                    'nb_jar' => $user->pivot->nb_jar,
                    'user_name' => $user->lastname . ' ' . $user->firstname,
                    'created_at' => $user->pivot->created_at->format('d/m/Y'),
                ];
            }
            
        }

        //get the records of honeyjar where other_person is not null use DB format date (Y-m-d H:i:s)
        $other_records = DB::table('honey_jar_user')
            ->join('honey_jars', 'honey_jars.id', '=', 'honey_jar_user.honey_jar_id')
            ->select('honey_jars.size', 'honey_jar_user.nb_jar', 'honey_jar_user.other_person', 'honey_jar_user.created_at')
            ->whereNotNull('honey_jar_user.other_person')
            ->get();

        //add the other records to the records array
        foreach ($other_records as $other_record) {
            $records[] = [
                'size' => $other_record->size,
                'nb_jar' => $other_record->nb_jar,
                'user_name' => $other_record->other_person,
                'created_at' => date('d/m/Y', strtotime($other_record->created_at)),
            ];
        }

        //sort records by date then user_name
        usort($records, function ($a, $b) {
            return $a['created_at'] <=> $b['created_at'] ?: $a['user_name'] <=> $b['user_name'];
        });
   
        //GET ONLY THE NON DELETED ONEs
        $honeyjars = HoneyJar::all();

        $honeyjars = $honeyjars->map(function ($honeyjar) {
            return [
                'id' => $honeyjar->id,
                'size' => $honeyjar->size,
                'nb_jar' => $honeyjar->nb_jar,
            ];
        });

        //dd($honeyjars);

        return Inertia::render('InventoryHoney', [
            'honey_jars' => $honeyjars,
            'records' => $records,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        //print $request
        //print_r($request->all());

        $request->validate([
            'size' => 'required|string|max:255',
            'nb_jar' => 'required|numeric',
        ]);

        $honeyjar = HoneyJar::create([
            'size' => $request->size,
            'nb_jar' => $request->nb_jar,
        ]);

        return redirect()->route('inventoryHoney');
    }

    public function harvest(Request $request) {
        //validate jars array in request
        $request->validate([
            'jars' => 'required|array',
        ]);

        //foreach jar in jars array, get the jar and update nb_jar
        foreach ($request->jars as $jar) {

            $honey_jar = HoneyJar::find($jar['id']);

            $honey_jar->nb_jar = $honey_jar->nb_jar + $jar['number'];

            $honey_jar->save();

        }

        $apiary = Apiary::find($request->apiary_id);

        // //return to hive page
        return redirect()->route('hive', ['apiary' => $apiary]);
    }

    public function destroy(String $honey_jar_id)
    {
        $honey_jar = HoneyJar::find($honey_jar_id);

        // soft delete
        $honey_jar->delete();

        return redirect()->route('inventoryHoney');
    }

    public function createRecord(Request $request) {
        $request->validate([
            'jar' => 'required|numeric',
            'nb_jar' => 'required|numeric',
        ]);
        

        //get jar
        $honey_jar = HoneyJar::find($request->jar);

        //update nb_jar in honey_jar table where current nb_jar - nb_jar in request
        //if nb_jar is negative, return error
        
        if ($honey_jar->nb_jar - $request->nb_jar < 0) {
            //dd('error');
            return redirect()->route('inventoryHoney');
        } else {
            $honey_jar->update([
                'nb_jar' => $honey_jar->nb_jar - $request->nb_jar,
            ]);
        }

        //if user is not 0, get user
        if ($request->user != 0) {
            //get user
            $user = User::find($request->user);
        } else {
            $user = $request->user;
        }
        
        //if date is null, set it to now
        if ($request->created_at == null) {
            $request->created_at = now();
        }

        //dd($request->all());

        if ($request->user == 0) {
            //attach user to honey_jar with nb_jar
            $honey_jar->users()->attach($user, ['nb_jar' => $request->nb_jar, 'created_at' => $request->created_at, 'other_person' => $request->other_person]);
        } else {
            //attach user to honey_jar with nb_jar
            $honey_jar->users()->attach($user, ['nb_jar' => $request->nb_jar, 'created_at' => $request->created_at, 'other_person' => $request->other_person]);
        }

        return redirect()->route('inventoryHoney');
    }

    public function update(Request $request, HoneyJar $honey_jar)
    {
        $request->validate([
            'nb_jar' => 'required|numeric',
        ]);

        $honey_jar->update([
            'nb_jar' => $request->nb_jar,
        ]);

        return redirect()->route('inventoryHoney');
    }
}
