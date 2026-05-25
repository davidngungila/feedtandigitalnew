@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">My Savings Accounts</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($accounts as $account)
        <div class="card rounded-2xl p-6 border relative overflow-hidden group hover:border-primary-500 transition-all"
             :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center">
                    <i class="fa-solid fa-piggy-bank"></i>
                </div>
                <span class="badge badge-green text-[10px]">{{ $account->status }}</span>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ $account->account_no }}</p>
            <h3 class="text-lg font-bold mb-1" :class="darkMode?'text-white':'text-primary-900'">{{ $account->savingsProduct->name ?? $account->product_type }}</h3>
            <p class="text-2xl font-bold text-primary-600 mb-4">TZS {{ number_format($account->balance, 2) }}</p>
            
            <div class="pt-4 border-t flex justify-between items-center" :class="darkMode?'border-[#1a3328]':'border-primary-50'">
                <span class="text-[10px] text-gray-500">Interest: {{ $account->savingsProduct->interest_rate ?? 0 }}% p.a</span>
                <a href="{{ route('portal.statements', ['account' => $account->id]) }}" class="text-[10px] font-bold text-primary-500 hover:underline">STATEMENTS</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
