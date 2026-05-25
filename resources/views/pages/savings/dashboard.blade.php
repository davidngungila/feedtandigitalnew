@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Savings & Deposits Dashboard</h2>
        <div class="flex gap-2">
            <a href="{{ route('deposits.new') }}" class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
                <i class="fa-solid fa-plus mr-1.5"></i> New Deposit
            </a>
            <a href="{{ route('withdrawals.new') }}" class="px-4 py-2 rounded-xl bg-red-600 text-white text-xs font-semibold hover:bg-red-500 transition-all">
                <i class="fa-solid fa-minus mr-1.5"></i> New Withdrawal
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center">
                    <i class="fa-solid fa-vault"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-400':'text-primary-500'">Total Savings</p>
                    <h3 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS {{ number_format($stats['total_savings'], 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-green-500/10 text-green-500 flex items-center justify-center">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-400':'text-primary-500'">Active Accounts</p>
                    <h3 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $stats['active_accounts'] }}</h3>
                </div>
            </div>
        </div>
        <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center">
                    <i class="fa-solid fa-box-archive"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-400':'text-primary-500'">Total Products</p>
                    <h3 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $stats['total_products'] }}</h3>
                </div>
            </div>
        </div>
        <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-orange-500/10 text-orange-500 flex items-center justify-center">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-400':'text-primary-500'">Avg Balance</p>
                    <h3 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS {{ $stats['active_accounts'] > 0 ? number_format($stats['total_savings'] / $stats['active_accounts'], 2) : 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="card rounded-2xl p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Recent Savings Transactions</h3>
            <a href="{{ route('deposits.history') }}" class="text-xs text-primary-600 hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">Date</th>
                        <th class="text-left">Member</th>
                        <th class="text-left">Account No</th>
                        <th class="text-left">Type</th>
                        <th class="text-right">Amount (TZS)</th>
                        <th class="text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_transactions'] as $transaction)
                    <tr class="table-row">
                        <td class="text-xs">{{ $transaction->created_at->format('M d, Y') }}</td>
                        <td class="text-xs font-semibold">{{ $transaction->member->user->name ?? 'N/A' }}</td>
                        <td class="text-xs font-mono">{{ $transaction->savingsAccount->account_no ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $transaction->type == 'deposit' ? 'badge-green' : 'badge-red' }} text-[10px] uppercase">
                                {{ $transaction->type }}
                            </span>
                        </td>
                        <td class="text-right text-xs font-bold {{ $transaction->type == 'deposit' ? 'text-green-500' : 'text-red-500' }}">
                            {{ number_format($transaction->amount, 2) }}
                        </td>
                        <td><span class="badge badge-blue text-[10px]">{{ ucfirst($transaction->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
