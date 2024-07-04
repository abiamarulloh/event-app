<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Stevebauman\Location\Facades\Location;

class EventController extends Controller
{
    //
    public function index(Request $request): View
    {
        $ip = file_get_contents('https://api.ipify.org');
        $currentUserInfo = Location::get($ip);
        return view('explore', compact('currentUserInfo'));
    }
}
