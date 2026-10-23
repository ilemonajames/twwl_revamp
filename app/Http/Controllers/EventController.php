<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function signup($id, Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $event = Event::findOrFail($id);
        $eventReg = EventRegistration::where('email', $data['email'])->where('event_id', $id)->first();

        if ($eventReg != null) {
            return back()->with('errorfeedback', 'You already registered for this event')->withInput();
        } else {
            EventRegistration::create([
                'name' => $data['name'],
                'phoneno' => $data['phone'],
                'email' => $data['email'],
                'name' => $data['name'],
                'event_id' => $id,
                'type' => $event->type_of_event,
            ]);

            return back()->with('feedback', 'Event Registration Successful');
        }

    }
}
