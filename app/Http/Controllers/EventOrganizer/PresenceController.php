<?php

namespace App\Http\Controllers\EventOrganizer;

use App\Events\SendEmailEventRequestFeedback;
use App\Events\SendEmailEventRequestStatusMail;
use App\Http\Controllers\Controller;
use App\Mail\EventRequestStatusMail;
use App\Models\Event;
use App\Models\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events =  Event::with('category')
        ->where('status', 'published')
        ->withCount('eventRequests')
        ->get();

        return view('event_organizer.presence.index', compact('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eventRequest = EventRequest::with('event', 'customer')->where('event_id', $id)->get();
        return view('event_organizer.presence.show', compact('eventRequest'));
    }

    public function approve(Request $request, $id)
    {
        $eventRequest = EventRequest::with('event', 'customer', 'order')->findOrFail($id);
        $eventRequest->status = 'approved';
        $eventRequest->save();
        
        $eventRequest->organizer = Auth::user();
        $eventRequest->attender =  $eventRequest->customer;

        $details = new \stdClass();
        $details->status = $eventRequest->status;
        $details->organizer = $eventRequest->organizer;
        $details->attender = $eventRequest->attender;
        $details->event = $eventRequest->event;

        // Kirim email notifikasi balikan ke attender
        event(new SendEmailEventRequestStatusMail($details, $eventRequest->attender->email));

        flash()->flash('success', 'Request approved!');
        return back();
    }

    public function reject(Request $request, $id)
    {
        $eventRequest = EventRequest::with('event', 'customer', 'order')->findOrFail($id);
        $eventRequest->status = 'rejected';
        $eventRequest->save();

        $eventRequest->organizer = Auth::user();
        $eventRequest->attender =  $eventRequest->customer;

        $details = new \stdClass();
        $details->status = $eventRequest->status;
        $details->organizer = $eventRequest->organizer;
        $details->attender = $eventRequest->attender;
        $details->event = $eventRequest->event;

        event(new SendEmailEventRequestStatusMail($details, $eventRequest->attender->email));

        flash()->flash('success', 'Request rejected!');
        return back();
    }

    public function pending(Request $request, $id)
    {
        $eventRequest = EventRequest::with('event', 'customer', 'order')->findOrFail($id);
        $eventRequest->status = 'pending';
        $eventRequest->save();

        $eventRequest->organizer = Auth::user();
        $eventRequest->attender =  $eventRequest->customer;

        $details = new \stdClass();
        $details->status = $eventRequest->status;
        $details->organizer = $eventRequest->organizer;
        $details->attender = $eventRequest->attender;
        $details->event = $eventRequest->event;

        event(new SendEmailEventRequestStatusMail($details, $eventRequest->attender->email));

        flash()->flash('success', 'Request Canceled!');
        return back();
    }
}
