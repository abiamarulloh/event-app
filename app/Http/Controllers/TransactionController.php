<?php

// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('order')->get();
        return view('event_organizer.transactions.index', compact('transactions'));
    }

    public function notification(Request $request)
    {
        $payload = $request->all()['json'];
        $notification = json_decode($payload);

        $transactionStatus = $notification->transaction_status;
        $unique_order_id = $notification->order_id;
        $transactionId = $notification->transaction_id;

        $order = Order::where('unique_order_id', $unique_order_id)->first();

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $status = 'success';
        } else if ($transactionStatus == 'pending') {
            $status = 'pending';
        } else {
            $status = 'failed';
        }

        Transaction::create([
            'order_id' => $order->id,
            'transaction_id' => $transactionId,
            'status' => $status,
        ]);

        Cart::where('user_id', $order->user_id)->delete();

        flash()->flash('success', 'Order Berhasil');

        return Redirect::route('history.detail', $order->id);
    }
}
