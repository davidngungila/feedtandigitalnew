<?php

namespace App\Http\Controllers;

use App\Models\SavingsAccount;
use App\Models\Transaction;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function new()
    {
        $accounts = SavingsAccount::with('member')->where('status', 'Active')->get();
        return view('pages.withdrawals.new', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'savings_account_id' => 'required|exists:savings_accounts,id',
            'amount' => 'required|numeric|min:1',
            'channel' => 'required|string',
            'reason' => 'nullable|string',
        ]);

        $account = SavingsAccount::find($validated['savings_account_id']);

        if ($account->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Insufficient balance']);
        }

        WithdrawalRequest::create([
            'member_id' => $account->member_id,
            'savings_account_id' => $account->id,
            'amount' => $validated['amount'],
            'channel' => $validated['channel'],
            'reason' => $validated['reason'],
            'status' => 'pending'
        ]);

        return redirect()->route('withdrawals.requests')->with('success', 'Withdrawal request submitted for approval');
    }

    public function requests()
    {
        $requests = WithdrawalRequest::with(['member', 'savingsAccount'])->where('status', 'pending')->latest()->get();
        return view('pages.withdrawals.requests', compact('requests'));
    }

    public function history()
    {
        $history = WithdrawalRequest::with(['member', 'savingsAccount'])->latest()->get();
        return view('pages.withdrawals.history', compact('history'));
    }

    public function approve(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        DB::transaction(function () use ($withdrawalRequest) {
            $account = SavingsAccount::lockForUpdate()->find($withdrawalRequest->savings_account_id);
            
            if ($account->balance < $withdrawalRequest->amount) {
                throw new \Exception('Insufficient balance at the time of approval');
            }

            $account->balance -= $withdrawalRequest->amount;
            $account->save();

            $withdrawalRequest->update([
                'status' => 'approved',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
                'reference' => 'WD-' . time()
            ]);

            Transaction::create([
                'member_id' => $account->member_id,
                'savings_account_id' => $account->id,
                'type' => 'withdrawal',
                'amount' => $withdrawalRequest->amount,
                'balance_after' => $account->balance,
                'channel' => $withdrawalRequest->channel,
                'reference' => $withdrawalRequest->reference,
                'narration' => 'Withdrawal: ' . $withdrawalRequest->reason,
                'status' => 'completed'
            ]);
        });

        return back()->with('success', 'Withdrawal request approved successfully');
    }

    public function reject(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $withdrawalRequest->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
            'rejection_reason' => $validated['rejection_reason']
        ]);

        return back()->with('success', 'Withdrawal request rejected');
    }

    public function approved()
    {
        $approved = WithdrawalRequest::with(['member', 'savingsAccount'])->where('status', 'approved')->latest()->get();
        return view('pages.withdrawals.approved', compact('approved'));
    }

    public function rejected()
    {
        $rejected = WithdrawalRequest::with(['member', 'savingsAccount'])->where('status', 'rejected')->latest()->get();
        return view('pages.withdrawals.rejected', compact('rejected'));
    }
}
