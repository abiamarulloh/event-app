<?php

namespace App\Http\Controllers\EventOrganizer;

use App\Events\SendEmailEventRequest;
use App\Events\SendEmailEventRequestFeedback;
use App\Events\SendEmailEventRequestStatusMail;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $eventId = $id;
        return view('event_organizer.presence.show', compact('eventRequest', 'eventId'));
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

         // Update the related order's status
         Order::where('id', $eventRequest->order->id)
         ->update(['status_attend' => 'approved']);

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

         // Update the related order's status
         Order::where('id', $eventRequest->order->id)
         ->update(['status_attend' => 'waiting']);

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

         // Update the related order's status
         Order::where('id',  $eventRequest->order->id)
         ->update(['status_attend' => 'waiting']);

        event(new SendEmailEventRequestStatusMail($details, $eventRequest->attender->email));

        flash()->flash('success', 'Request Canceled!');
        return back();
    }

    public function scanQR(Request $request)
    {
        $qrCodeData = $request->input('qr_code');
        $eventId = $request->input('event_id');


        $transaction = Transaction::whereHas('order', function ($query) use ($qrCodeData) {
            $query->where('unique_order_id', $qrCodeData);
        })->with('order')->first();

        if (!$transaction) {
            flash()->flash('error', 'Data tidak dikenali!');
            return redirect()->back();
        }

        $eventRequestAlready = EventRequest::where('customer_id', $transaction->order->user_id)->first();
        if ($eventRequestAlready) {
            flash()->flash('warning', 'Data sudah masuk, check tabel!');
            return redirect()->back();
        }

        if ($eventId != $transaction->order->event_id) {
            flash()->flash('warning', 'Event Mu, tidak sesuai, scan Event yang sesuai!');
            return redirect()->back();
        }

        $eventRequest = EventRequest::create([
            'customer_id' => $transaction->order->user_id,
            'event_id' => $transaction->order->event_id,
            'order_id' => $transaction->order_id,
            'status' => 'approved'
        ]);

        // Update the related order's status
        Order::where('id', $transaction->order_id)
        ->update(['status_attend' => 'approved']);
        
        $organizer = User::find(auth()->id());
        $attender = User::find($transaction->order->user_id);
        $event = Event::find($transaction->order->event_id);
    
        // Membuat object dengan data yang diperlukan
        $details = new \stdClass();
        $details->eventRequest = $eventRequest;
        $details->organizer = $organizer;
        $details->attender = $attender;
        $details->event = $event;

        // // Kirim email notifikasi ke Event Organizer
        event(new SendEmailEventRequest($details, $organizer->email));
        
        // // Kirim email notifikasi balikan ke attender
        event(new SendEmailEventRequestFeedback($details, $attender->email));

        // Process the QR code data here
        // For example, save to database, perform an action, etc.

        flash()->flash('success', 'Selamat Bergabung ' . $attender->name);
        return redirect()->back()->with('fragment', 'scannerSection');
    }

}
