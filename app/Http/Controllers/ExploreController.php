<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Midtrans\Snap;
use Stevebauman\Location\Facades\Location;

class ExploreController extends Controller
{
    //
    public function index(Request $request): View
    {
        $ip = file_get_contents('https://api.ipify.org');
        $currentUserInfo = Location::get($ip);
        $categories = Category::all();
        $events = Event::with('category')->get();
        return view('explore', compact('currentUserInfo', 'categories', 'events'));
    }

    public function show(String $slug ): View
    {
        $event = Event::with(['user'])->where('slug', $slug)->where('status', 'published')->first();
        $user = Auth::user();

        if (!$event) {
            abort(404);
        }

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $event->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'last_name' => '',
                'email' => $user->email,
                'phone' => '',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('detail-event', compact('event', 'snapToken'));
    }

    public function paymentHandler(Request $request)
    {
        // Handle the payment notification
        $notification = new \Midtrans\Notification();
        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $order_id = $notification->order_id;
        $fraud = $notification->fraud_status;
        
        // Implement your logic here to handle notification
    }
}
