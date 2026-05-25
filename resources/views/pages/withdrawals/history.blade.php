@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Withdrawal History</h2>
    </div>

    <div class="card rounded-2xl p-5">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">Date</th>
                        <th class="text-left">Member</th>
                        <th class="text-left">Account</th>
                        <th class="text-right">Amount (TZS)</th>
                        <th class="text-left">Channel</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Reference</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $item)
                    <tr class="table-row">
                        <td class="text-xs">{{ $item->created_at->format('M d, Y') }}</td>
                        <td class="text-xs font-semibold">{{ $item->member->user->name }}</td>
                        <td class="text-xs">{{ $item->savingsAccount->account_no }}</td>
                        <td class="text-right text-xs font-bold text-red-600">{{ number_format($item->amount, 2) }}</td>
                        <td class="text-xs">{{ $item->channel }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'approved' ? 'badge-green' : ($item->status == 'pending' ? 'badge-yellow' : 'badge-red') }} text-[10px]">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="text-xs font-mono">{{ $item->reference ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
