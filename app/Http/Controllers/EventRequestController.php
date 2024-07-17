<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRequest;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRequestApprovalMail;
use App\Mail\EventRequestFeedbackApprovalMail;

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
        
        $eventRequest->organizer = $organizer;
        $eventRequest->attender = User::find(auth()->id());
        $eventRequest->event = Event::find($request->event_id);

        // Kirim email notifikasi ke Event Organizer
        Mail::to($organizer->email)->send(new EventRequestApprovalMail($eventRequest));

        // Kirim email notifikasi balikan ke attender
        Mail::to($eventRequest->attender->email)->send(new EventRequestFeedbackApprovalMail($eventRequest));

        return back()->with('success', 'Request approval sent!');
    }
}
