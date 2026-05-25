@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Savings Summary Report</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($summary as $row)
        <div class="card rounded-2xl p-6 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-400':'text-primary-500'">{{ $row->product_type }}</h3>
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-gray-500">Total Accounts</span>
                <span class="text-sm font-bold">{{ $row->total_accounts }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500">Total Balance</span>
                <span class="text-sm font-bold text-primary-600">TZS {{ number_format($row->total_balance, 2) }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
