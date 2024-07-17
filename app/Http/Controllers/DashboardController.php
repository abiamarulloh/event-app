<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $usersQty = User::all()->count();
        $eventDraftQty = Event::all()->where('status', 'draft')->count();
        $eventPublishedQty = Event::all()->where('status', 'published')->count();
        $eventClosedQty = Event::all()->where('status', 'closed')->count();

        return view('dashboard', compact('usersQty', 'eventDraftQty', 'eventPublishedQty', 'eventClosedQty'));
    }
}
