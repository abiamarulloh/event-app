<?php

namespace App\Http\Controllers;

use App\Models\AdditionalFee;
use Illuminate\Http\Request;

class AdditionalFeeController extends Controller
{
    public function index()
    {
        $additionalFees = AdditionalFee::where('user_id', auth()->id())->get();
        return view('event_organizer.additional-fees.index', compact('additionalFees'));
    }

    public function create()
    {
        return view('event_organizer.additional-fees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:tax,charge',
            'name' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        AdditionalFee::create($data);

        flash()->flash('success', 'Data Berhasil dibuat');
        return redirect()->route('additional-fees.index');
    }

    public function edit(AdditionalFee $additionalFee)
    {
        return view('event_organizer.additional-fees.edit', compact('additionalFee'));
    }

    public function update(Request $request, AdditionalFee $additionalFee)
    {
        $request->validate([
            'type' => 'required|in:tax,charge',
            'name' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        $additionalFee->update($data);

        flash()->flash('success', 'Data Berhasil diperbarui');
        return redirect()->route('additional-fees.index');
    }

    public function destroy(AdditionalFee $additionalFee)
    {
        $additionalFee->delete();

        flash()->flash('success', 'Data Berhasil dihapus');
        return redirect()->route('additional-fees.index');
    }
}
