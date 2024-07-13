<?php

namespace App\Http\Controllers\EventOrganizer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $events = Event::all();
        $events = Event::with('category')->get();
        return view('event_organizer.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $isAdmin = Auth::user()->role_id == 1;
        $users = User::all();
        return view('event_organizer.events.create', compact('categories', 'isAdmin', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'quota' => 'required',
            'price' => 'required',
            'location' => 'required',
        ]);

        Event::create($request->all());

        flash()->flash('success', 'Acara berhasil dibuat.');
        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('event_organizer.events.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        $isAdmin = Auth::user()->role_id == 1;
        $users = User::all();
        return view('event_organizer.events.edit', compact('event', 'categories', 'isAdmin', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'quota' => 'required',
            'price' => 'required',
            'location' => 'required',
        ]);

        // Validate and update the event
        $event->update($request->all());
    
        flash()->flash('success', 'Acara <b>'. $event->title  . '</b> berhasil diperbarui.');
        // Redirect back to the event edit page with a success message
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        flash()->flash('success', 'Acara <b>'. $event->title  . '</b> berhasil dihapus.');
        return redirect()->route('event.index');
    }
}
