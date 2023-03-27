<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        //get all events
        $events = Event::all();

        //map events to array
        $events = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->date_start,
                'end' => $event->date_end,
            ];
        });

        return Inertia::render('Events', [
            'events' => $events,]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date_start' => 'required | date',
            'date_end' => 'required | date',
        ]);

        Event::create(
            $request->only('title', 'date_start', 'date_end')
        );

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
            $request->only('title', 'date_start', 'date_end')
        );

        return redirect()->route('events');
    }
}
