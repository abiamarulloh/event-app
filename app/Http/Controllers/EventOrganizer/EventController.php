<?php

namespace App\Http\Controllers\EventOrganizer;

use App\Http\Controllers\Controller;
use App\Models\AdditionalFee;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $users = User::all()->where('role_id', 2);
        $additionalFees = AdditionalFee::all();
        return view('event_organizer.events.create', compact('categories', 'isAdmin', 'users', 'additionalFees'));
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
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fundraising_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fundraising_title' => 'nullable|string|max:200',
            'fundraising_description' => 'nullable|string|max:200',
            'fundraising_target' => 'nullable|numeric',
            'sponsorship_target' => 'nullable|numeric',
            'sponsorship_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sponsorship_title' => 'nullable|string|max:200',
            'sponsorship_description' => 'nullable|string|max:200',
            'sponsorship_target' => 'nullable|numeric'
        ]);

        if ($request->hasFile('poster_image')) {
            $imagePosterName = time().'.'.$request->poster_image->extension();
            $request->poster_image->storeAs('public/events', $imagePosterName);
        } else {
            $imagePosterName = null;
        }

        if ($request->hasFile('fundraising_image')) {
            $imageFundraisingName = time().'.'.$request->fundraising_image->extension();
            $request->fundraising_image->storeAs('public/fundraising', $imageFundraisingName);
        } else {
            $imageFundraisingName = null;
        }

        if ($request->hasFile('sponsorship_image')) {
            $imageSponsorshipName = time().'.'.$request->sponsorship_image->extension();
            $request->sponsorship_image->storeAs('public/sponsorship', $imageSponsorshipName);
        } else {
            $imageSponsorshipName = null;
        }
        
        $data = $request->all();
        $data['poster_image'] = $imagePosterName;
        $data['fundraising_image'] = $imageFundraisingName;
        $data['sponsorship_image'] = $imageSponsorshipName;

        Event::create($data);

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
        $users = User::all()->where('role_id', 2);
        $additionalFees = AdditionalFee::all();
        return view('event_organizer.events.edit', compact('event', 'categories', 'isAdmin', 'users', 'additionalFees'));
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
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fundraising_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fundraising_title' => 'nullable|string|max:200',
            'fundraising_description' => 'nullable|string|max:200',
            'sponsorship_target' => 'nullable|numeric',
            'sponsorship_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sponsorship_title' => 'nullable|string|max:200',
            'sponsorship_description' => 'nullable|string|max:200',
            'sponsorship_target' => 'nullable|numeric'
        ]);

        if ($request->hasFile('poster_image')) {
            if ($event->poster_image) {
                Storage::delete('public/events/' . $event->poster_image);
            }
            $imagePosterName = time().'.'.$request->poster_image->extension();
            $request->poster_image->storeAs('public/events', $imagePosterName);
        } else {
            $imagePosterName = $event->poster_image;
        }

        if ($request->hasFile('fundraising_image')) {
            // Hapus gambar dari penyimpanan jika ada
            if ($event->fundraising_image) {
                Storage::delete('public/fundraising/' . $event->fundraising_image);
            }
            $imageFundraisingName = time().'.'.$request->fundraising_image->extension();
            $request->fundraising_image->storeAs('public/fundraising', $imageFundraisingName);
        } else {
            $imageFundraisingName = $event->fundraising_image;
        }

        if ($request->hasFile('sponsorship_image')) {
            // Hapus gambar dari penyimpanan jika ada
            if ($event->sponsorship_image) {
                Storage::delete('public/sponsorship/' . $event->sponsorship_image);
            }
            $imageSponsorshipName = time().'.'.$request->sponsorship_image->extension();
            $request->sponsorship_image->storeAs('public/sponsorship', $imageSponsorshipName);
        } else {
            $imageSponsorshipName = $event->sponsorship_image;
        }
        
        $event->fill($request->all());
        $event->poster_image = $imagePosterName;

        $event->fundraising_image = $imageFundraisingName;
        $event->fundraising_title = $request->fundraising_title;
        $event->fundraising_description = $request->fundraising_description;
        $event->fundraising_target = $request->fundraising_target;

        $event->sponsorship_image = $imageSponsorshipName;
        $event->sponsorship_title = $request->sponsorship_title;
        $event->sponsorship_description = $request->sponsorship_description;
        $event->sponsorship_target = $request->sponsorship_target;

        $event->save();
    
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

    public function deleteImage($id)
    {
        $event = Event::findOrFail($id);

        // Hapus gambar dari penyimpanan jika ada
        if ($event->poster_image) {
            Storage::delete('public/events/' . $event->poster_image);
            $event->poster_image = null; // Kosongkan field poster_image di database
            $event->save();
        }

        return redirect()->route('event.index', ['id' => $event->id])->with('success', 'Image deleted successfully.');
    }
}
