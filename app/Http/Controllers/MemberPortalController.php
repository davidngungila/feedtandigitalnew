<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Loan;
use App\Models\SavingsAccount;
use App\Models\Investment;
use App\Models\Transaction;

class MemberPortalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $member = $user->member;

        if (!$member) {
            return redirect()->route('dashboard')->with('error', 'No member profile associated with this account.');
        }

        $stats = [
            'total_savings' => $member->savingsAccounts()->sum('balance'),
            'active_loans' => $member->loans()->whereIn('status', ['active', 'overdue'])->sum('balance'),
            'total_investments' => $member->investments()->where('status', 'Active')->sum('principal'),
            'recent_transactions' => Transaction::where('member_id', $member->id)->latest()->take(5)->get()
        ];

        return view('pages.member_portal.dashboard', compact('member', 'stats'));
    }

    public function profile()
    {
        $member = Auth::user()->member;
        return view('pages.member_portal.profile', compact('member'));
    }

    public function loans()
    {
        $member = Auth::user()->member;
        $loans = $member->loans()->latest()->get();
        return view('pages.member_portal.loans', compact('member', 'loans'));
    }

    public function savings()
    {
        $member = Auth::user()->member;
        $accounts = $member->savingsAccounts()->with('savingsProduct')->latest()->get();
        return view('pages.member_portal.savings', compact('member', 'accounts'));
    }

    public function statements()
    {
        $member = Auth::user()->member;
        $accounts = $member->savingsAccounts;
        return view('pages.member_portal.statements', compact('member', 'accounts'));
    }
}
