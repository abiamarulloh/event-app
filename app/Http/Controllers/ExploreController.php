<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Stevebauman\Location\Facades\Location;

class ExploreController extends Controller
{
    //
    public function index(Request $request): View
    {
        // $ip = file_get_contents('https://api.ipify.org');
        // $currentUserInfo = Location::get('127.0.0.1');
        $categories = Category::all();
        $events = Event::with('category')->get();
        return view('explore', compact('categories', 'events'));
    }

    public function show(String $slug ): View
    {
        $event = Event::with(['user'])->where('slug', $slug)->whereNot('status', 'draft')->first();
        $alreadyAddedCart = Cart::where('user_id', auth()->id())->first();

        if (!$event) {
            abort(404);
        }

        return view('detail-event', compact('event', 'alreadyAddedCart'));
    }
}
