@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Open Savings Account</h2>
    </div>

    <div class="card rounded-2xl p-6 max-w-2xl">
        <form action="{{ route('savings.accounts.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Select Member *</label>
                    <select name="member_id" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="">-- Choose Member --</option>
                        @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->user->name }} ({{ $member->member_no }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Savings Product *</label>
                    <select name="savings_product_id" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="">-- Choose Product --</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->interest_rate }}% p.a)</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Initial Deposit (Opening Balance)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">TZS</span>
                    <input type="number" name="opening_balance" value="0" step="0.01" class="input-field w-full rounded-xl border p-2.5 pl-12 text-sm font-bold" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <p class="text-[10px] mt-1 text-gray-500">The amount will be automatically deposited into the new account.</p>
            </div>

            <div class="flex gap-4 pt-6">
                <a href="{{ route('savings.accounts') }}" class="flex-1 py-3 rounded-xl border font-bold text-xs text-center">Cancel</a>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-primary-600 text-white font-bold text-xs hover:bg-primary-500 transition-all">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
