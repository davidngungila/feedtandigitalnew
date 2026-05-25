@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Account Statements</h2>
    </div>

    <div class="card rounded-2xl p-6 max-w-2xl">
        <form action="{{ route('statements.view') }}" method="GET" class="space-y-6">
            <div>
                <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Select Account</label>
                <select name="savings_account_id" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                    @foreach($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->account_no }} - {{ $account->product_type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Start Date</label>
                    <input type="date" name="start_date" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">End Date</label>
                    <input type="date" name="end_date" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 rounded-xl bg-primary-600 text-white font-bold text-xs hover:bg-primary-500 transition-all">
                    Generate Statement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
