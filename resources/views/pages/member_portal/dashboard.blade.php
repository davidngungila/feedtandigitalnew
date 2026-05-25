@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Welcome, {{ Auth::user()->name }}</h2>
            <p class="text-sm" :class="darkMode?'text-primary-400':'text-gray-500'">Member No: {{ $member->member_no }} | Branch: {{ Auth::user()->branch }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('portal.profile') }}" class="px-4 py-2 rounded-xl border text-xs font-semibold hover:bg-primary-50 transition-all">
                <i class="fa-solid fa-user-gear mr-1.5"></i> Edit Profile
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card rounded-2xl p-6 border group hover:border-primary-500 transition-all" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-500 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-vault"></i>
                </div>
                <a href="{{ route('portal.savings') }}" class="text-[10px] font-bold text-primary-500 hover:underline">VIEW ALL</a>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Savings</p>
            <h3 class="text-2xl font-bold mt-1" :class="darkMode?'text-white':'text-primary-900'">TZS {{ number_format($stats['total_savings'], 2) }}</h3>
        </div>

        <div class="card rounded-2xl p-6 border group hover:border-red-500 transition-all" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-500 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <a href="{{ route('portal.loans') }}" class="text-[10px] font-bold text-primary-500 hover:underline">VIEW ALL</a>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Loan Balance</p>
            <h3 class="text-2xl font-bold mt-1" :class="darkMode?'text-white':'text-primary-900'">TZS {{ number_format($stats['active_loans'], 2) }}</h3>
        </div>

        <div class="card rounded-2xl p-6 border group hover:border-green-500 transition-all" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-green-500/10 text-green-500 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <span class="text-[10px] font-bold text-green-500">ACTIVE</span>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Investments</p>
            <h3 class="text-2xl font-bold mt-1" :class="darkMode?'text-white':'text-primary-900'">TZS {{ number_format($stats['total_investments'], 2) }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="card rounded-2xl p-6">
            <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">Recent Activity</h3>
            <div class="space-y-4">
                @forelse($stats['recent_transactions'] as $tx)
                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-[#0a140e] border border-transparent hover:border-primary-500/30 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs {{ $tx->type == 'deposit' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                            <i class="fa-solid {{ $tx->type == 'deposit' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ ucfirst($tx->type) }}</p>
                            <p class="text-[10px] text-gray-500">{{ $tx->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold {{ $tx->type == 'deposit' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $tx->type == 'deposit' ? '+' : '-' }} {{ number_format($tx->amount, 2) }}
                        </p>
                        <p class="text-[10px] text-gray-400">Ref: {{ $tx->reference }}</p>
                    </div>
                </div>
                @empty
                <p class="text-xs text-center py-4 text-gray-500 italic">No recent activity found.</p>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card rounded-2xl p-6">
            <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">Quick Access</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('portal.profile') }}" class="p-4 rounded-2xl border flex flex-col items-center gap-2 hover:bg-primary-50 transition-all" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
                    <i class="fa-solid fa-id-card text-xl text-primary-500"></i>
                    <span class="text-xs font-bold">My Profile</span>
                </a>
                <a href="{{ route('portal.loans') }}" class="p-4 rounded-2xl border flex flex-col items-center gap-2 hover:bg-primary-50 transition-all" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
                    <i class="fa-solid fa-file-invoice-dollar text-xl text-orange-500"></i>
                    <span class="text-xs font-bold">My Loans</span>
                </a>
                <a href="{{ route('portal.savings') }}" class="p-4 rounded-2xl border flex flex-col items-center gap-2 hover:bg-primary-50 transition-all" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
                    <i class="fa-solid fa-piggy-bank text-xl text-blue-500"></i>
                    <span class="text-xs font-bold">My Savings</span>
                </a>
                <a href="{{ route('portal.statements') }}" class="p-4 rounded-2xl border flex flex-col items-center gap-2 hover:bg-primary-50 transition-all" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
                    <i class="fa-solid fa-receipt text-xl text-purple-500"></i>
                    <span class="text-xs font-bold">Statements</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
