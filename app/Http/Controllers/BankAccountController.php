<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;

class BankAccountController extends Controller
{
    public function create()
    {
        return view('event_organizer.bank_accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string',
            'bank_name' => 'required|string',
            'account_holder_name' => 'required|string',
        ]);

        BankAccount::create([
            'event_organizer_id' => auth()->id(), // Assuming the event organizer is authenticated
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
        ]);

        flash()->flash('success', 'Bank account added successfully');
        return redirect()->route('bank-accounts.index');
    }

    public function index()
    {
        $bankAccounts = BankAccount::where('event_organizer_id', auth()->id())->get();
        return view('event_organizer.bank_accounts.index', compact('bankAccounts'));
    }
}
