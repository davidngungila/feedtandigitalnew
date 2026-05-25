<?php

namespace App\Http\Controllers;

use App\Models\SavingsAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingsReportController extends Controller
{
    public function summary()
    {
        $summary = SavingsAccount::select('product_type', DB::raw('count(*) as total_accounts'), DB::raw('sum(balance) as total_balance'))
            ->groupBy('product_type')
            ->get();
            
        return view('pages.reports.savings.summary', compact('summary'));
    }

    public function deposits()
    {
        $deposits = Transaction::deposits()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total_amount'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->latest()
            ->get();
            
        return view('pages.reports.savings.deposits', compact('deposits'));
    }

    public function withdrawals()
    {
        $withdrawals = Transaction::withdrawals()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total_amount'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->latest()
            ->get();
            
        return view('pages.reports.savings.withdrawals', compact('withdrawals'));
    }

    public function branch()
    {
        // Assuming members have a branch or region
        $branchReports = DB::table('members')
            ->join('savings_accounts', 'members.id', '=', 'savings_accounts.member_id')
            ->select('members.region as branch', DB::raw('count(savings_accounts.id) as total_accounts'), DB::raw('sum(savings_accounts.balance) as total_balance'))
            ->groupBy('members.region')
            ->get();
            
        return view('pages.reports.savings.branch', compact('branchReports'));
    }
}
