<?php

namespace App\Http\Controllers;

use App\Models\SavingsAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function new()
    {
        $accounts = SavingsAccount::with('member')->where('status', 'Active')->get();
        return view('pages.deposits.new', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'savings_account_id' => 'required|exists:savings_accounts,id',
            'amount' => 'required|numeric|min:1',
            'channel' => 'required|string',
            'reference' => 'required|string|unique:transactions,reference',
            'narration' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            $account = SavingsAccount::lockForUpdate()->find($validated['savings_account_id']);
            $account->balance += $validated['amount'];
            $account->save();

            Transaction::create([
                'member_id' => $account->member_id,
                'savings_account_id' => $account->id,
                'type' => 'deposit',
                'amount' => $validated['amount'],
                'balance_after' => $account->balance,
                'channel' => $validated['channel'],
                'reference' => $validated['reference'],
                'narration' => $validated['narration'],
                'status' => 'completed'
            ]);
        });

        return redirect()->route('deposits.history')->with('success', 'Deposit processed successfully');
    }

    public function history()
    {
        $deposits = Transaction::deposits()->with(['member', 'savingsAccount'])->latest()->get();
        return view('pages.deposits.history', compact('deposits'));
    }

    public function bulk()
    {
        return view('pages.deposits.bulk');
    }

    public function mobile()
    {
        return view('pages.deposits.mobile');
    }

    public function pending()
    {
        $pending = Transaction::deposits()->where('status', 'pending')->latest()->get();
        return view('pages.deposits.pending', compact('pending'));
    }

    public function reports()
    {
        return view('pages.deposits.reports');
    }
}
