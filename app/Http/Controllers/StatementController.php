<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\SavingsAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StatementController extends Controller
{
    public function member()
    {
        $members = Member::all();
        return view('pages.statements.member', compact('members'));
    }

    public function savings()
    {
        $accounts = SavingsAccount::with('member')->get();
        return view('pages.statements.savings', compact('accounts'));
    }

    public function download()
    {
        return view('pages.statements.download');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'savings_account_id' => 'required|exists:savings_accounts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $account = SavingsAccount::with('member')->find($validated['savings_account_id']);
        $transactions = Transaction::where('savings_account_id', $account->id)
            ->whereBetween('created_at', [$validated['start_date'], $validated['end_date']])
            ->oldest()
            ->get();

        return view('pages.statements.view', compact('account', 'transactions', 'validated'));
    }
}
