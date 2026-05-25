@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Branch Savings Report</h2>
    </div>

    <div class="card rounded-2xl p-5">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">Branch / Region</th>
                        <th class="text-right">Total Accounts</th>
                        <th class="text-right">Total Savings (TZS)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branchReports as $report)
                    <tr class="table-row">
                        <td class="text-xs font-bold">{{ $report->branch ?? 'Main Branch' }}</td>
                        <td class="text-right text-xs">{{ $report->total_accounts }}</td>
                        <td class="text-right text-xs font-bold">{{ number_format($report->total_balance, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
