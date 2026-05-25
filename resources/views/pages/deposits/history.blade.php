@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Deposit History</h2>
        <div class="flex gap-2">
            <button class="px-4 py-2 rounded-xl border text-xs font-semibold"><i class="fa-solid fa-filter mr-1.5"></i> Filter</button>
            <button class="px-4 py-2 rounded-xl bg-green-600 text-white text-xs font-semibold"><i class="fa-solid fa-file-excel mr-1.5"></i> Export</button>
        </div>
    </div>

    <div class="card rounded-2xl p-5">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">Date</th>
                        <th class="text-left">Member</th>
                        <th class="text-left">Account</th>
                        <th class="text-left">Channel</th>
                        <th class="text-left">Reference</th>
                        <th class="text-right">Amount (TZS)</th>
                        <th class="text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposits as $deposit)
                    <tr class="table-row">
                        <td class="text-xs">{{ $deposit->created_at->format('M d, Y H:i') }}</td>
                        <td class="text-xs font-semibold">{{ $deposit->member->user->name }}</td>
                        <td class="text-xs">{{ $deposit->savingsAccount->account_no }}</td>
                        <td class="text-xs">{{ $deposit->channel }}</td>
                        <td class="text-xs font-mono">{{ $deposit->reference }}</td>
                        <td class="text-right text-xs font-bold text-green-600">{{ number_format($deposit->amount, 2) }}</td>
                        <td><span class="badge badge-blue text-[10px]">{{ ucfirst($deposit->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
