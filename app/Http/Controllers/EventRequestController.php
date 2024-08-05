<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEventRequest;
use App\Events\SendEmailEventRequestFeedback;
use Illuminate\Http\Request;
use App\Models\EventRequest;
use App\Models\User;
use App\Models\Event;

class EventRequestController extends Controller
{
    public function requestApproval(Request $request)
    {
        $eventRequest = EventRequest::create([
            'customer_id' => auth()->id(),
            'event_id' => $request->event_id,
            'order_id' => $request->order_id,
        ]);
        
        $organizer = User::find($request->event_organizer_id);
        $attender = User::find(auth()->id());
        $event = Event::find($request->event_id);
    
        // Membuat object dengan data yang diperlukan
        $details = new \stdClass();
        $details->eventRequest = $eventRequest;
        $details->organizer = $organizer;
        $details->attender = $attender;
        $details->event = $event;

        // Kirim email notifikasi ke Event Organizer
        event(new SendEmailEventRequest($details, $organizer->email));
        
        // Kirim email notifikasi balikan ke attender
        event(new SendEmailEventRequestFeedback($details, $attender->email));

        flash()->flash('success', 'Request approval sent!');
        return back();
    }
}
