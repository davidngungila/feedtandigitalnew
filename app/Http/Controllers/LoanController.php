<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function active()
    {
        $loans = Loan::with('member.user')
            ->whereIn('status', ['active', 'overdue'])
            ->latest()
            ->paginate(15);

        $stats = [
            'active_count' => Loan::whereIn('status', ['active', 'overdue'])->count(),
            'total_disbursed' => Loan::whereIn('status', ['active', 'overdue', 'paid'])->sum('principal'),
            'total_outstanding' => Loan::whereIn('status', ['active', 'overdue'])->sum('balance'),
            'overdue_count' => Loan::where('status', 'overdue')->count(),
        ];

        return view('pages.loans.active', compact('loans', 'stats'));
    }

    public function apply()
    {
        $members = Member::with('user')->get();
        return view('pages.loans.apply', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'loan_type' => 'required|string',
            'principal' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'term_months' => 'required|integer|min:1',
            'purpose' => 'nullable|string',
        ]);

        $installment = ($validated['principal'] + ($validated['principal'] * $validated['interest_rate'] / 100)) / $validated['term_months'];

        Loan::create([
            'member_id' => $validated['member_id'],
            'loan_no' => 'LN-' . strtoupper(uniqid()),
            'loan_type' => $validated['loan_type'],
            'principal' => $validated['principal'],
            'interest_rate' => $validated['interest_rate'],
            'term_months' => $validated['term_months'],
            'balance' => $validated['principal'] + ($validated['principal'] * $validated['interest_rate'] / 100),
            'installment_amount' => $installment,
            'status' => 'pending',
            'purpose' => $validated['purpose'],
        ]);

        return redirect()->route('loans.active')->with('success', 'Loan application submitted successfully.');
    }
}
