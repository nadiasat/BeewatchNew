<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        //get all events
        $events = Event::all();

        //foreatch events get users
        foreach ($events as $event) {
            $users = $event->users()->get();
            $users = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->firstname . ' ' . $user->lastname,
                ];
            });
            $event->users = $users;
        }

        //map events to array
        $events = $events->map(function ($event) {

            //map to every event then define backgroundColor based on type
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->date_start,
                'end' => $event->date_end,
                'description' => $event->description,
                'is_urgent' => $event->is_urgent,
                'textColor' => $event->is_urgent ? '#ffffff' : '#000000',
                'users' => $event->users,
            ];
        });

        //get all users
        $users = User::all();
        
        $users = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->firstname . ' ' . $user->lastname,
            ];
        });

        return Inertia::render('Events', [
            'events' => $events,
            'users' => $users,]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date_start' => 'required | date',
            'date_end' => 'required | date',
        ]);

        $event = Event::create(
            $request->only('title', 'date_start', 'date_end', 'description', 'is_urgent')
        );

        //associate auth user to event
        $event->users()->attach(auth()->user()->id);
        //sync usert to event
        $event->users()->sync($request->users);

        return redirect()->route('events');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events');
    }

    //update
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'date_start' => 'required | date',
            'date_end' => 'required | date',
        ]);

        $event->update(
            $request->only('title', 'date_start', 'date_end', 'description', 'is_urgent')
        );

        //sync usert to event
        $event->users()->sync($request->users);

        return redirect()->route('events');
    }
}
