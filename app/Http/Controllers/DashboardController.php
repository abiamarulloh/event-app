<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $usersQty = User::all()->count();
        
        $user = Auth::user();
        if ($user->role_id === 2) {
            $eventDraftQty = Event::all()->where('status', 'draft')->where('user_id', $user->id)->count();
            $eventPublishedQty = Event::all()->where('status', 'published')->where('user_id', $user->id)->count();
            $eventClosedQty = Event::all()->where('status', 'closed')->where('user_id', $user->id)->count();
            $transactionQty = Transaction::join('orders', 'transactions.order_id', '=', 'orders.id')
                            ->where('orders.event_organizer_id', $user->id)
                            ->count();
        } else {
            $eventDraftQty = Event::all()->where('status', 'draft')->count();
            $eventPublishedQty = Event::all()->where('status', 'published')->count();
            $eventClosedQty = Event::all()->where('status', 'closed')->count();
            $transactionQty = Transaction::all()->count();
        }

        return view('dashboard', compact('usersQty', 'eventDraftQty', 'eventPublishedQty', 'eventClosedQty', 'transactionQty'));
    }
}
