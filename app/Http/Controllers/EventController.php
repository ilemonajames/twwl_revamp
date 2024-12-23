<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\Event;

class EventController extends Controller
{
    Public function signup($id, Request $request){
        $data = $request->validate([
            'name' => ['required','string'],
            'phone' => ['required','string'],
            'email' => ['required','string'],
            'message' => ['required','string'],
        ]);

        $event = Event::find($id);
        $eventReg = EventRegistration::where('email',$data['email'])->where('event_id',$id)->first();

        if($eventReg!=null){
            return back()->with('errorfeedback','You already registered for this event')->withInput();
        }else{
            EventRegistration::create([
                'name' => $data['name'],
                'phoneno' => $data['phone'],
                'email' => $data['email'],
                'name' => $data['name'],
                'event_id' => $id,
                'type' => $event->type_of_event
            ]);

            return back()->with('feedback','Event Registration Successful');
        }

    }
}
