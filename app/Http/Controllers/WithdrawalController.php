<?php
namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::where('event_organizer_id', auth()->id())->with('bankAccount')->get();
        if (Auth::user()->role_id === 1) {
            $withdrawals = Withdrawal::with('bankAccount')->get();
        }

        return view('event_organizer.withdrawals.index', compact('withdrawals'));
    }

    public function create()
    {
        $eventOrganizer = auth()->user(); // Assuming the event organizer is authenticated
        $bankAccounts = BankAccount::all()->where('event_organizer_id', $eventOrganizer->id);
        return view('event_organizer.withdrawals.create', compact('bankAccounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $eventOrganizer = auth()->user(); // Assuming the event organizer is authenticated

        // Check if the event organizer has sufficient balance
        // if ($eventOrganizer->balance < $request->amount) {
        //     return back()->withErrors(['amount' => 'Insufficient balance']);
        // }

        // Create withdrawal request
        Withdrawal::create([
            'event_organizer_id' => $eventOrganizer->id,
            'bank_account_id' =>  $request->bank_account_id,
            'amount' => $request->amount
        ]);

        // $eventOrganizer->notify(new WithdrawalRequestNotification($withdrawal));

        flash()->flash('success', 'Withdrawal request submitted successfully');
        return redirect()->route('withdrawals.index');
    }

    public function show(Withdrawal $withdrawal)
    {
        return view('event_organizer.withdrawals.show', compact('withdrawal'));
    }

    public function update(Request $request, Withdrawal $withdrawal)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $withdrawal->update(
            ['status' => $request->status, 'reason' => $request->reason]
        );

        flash()->flash('success', 'Withdrawal status updated successfully');
        return redirect()->route('withdrawals.index');
    }
}
