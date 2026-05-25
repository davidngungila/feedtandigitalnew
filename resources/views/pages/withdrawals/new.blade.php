@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">New Withdrawal Request</h2>
    </div>

    <div class="card rounded-2xl p-6 max-w-2xl">
        <form action="{{ route('withdrawals.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Select Savings Account *</label>
                <select name="savings_account_id" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                    <option value="">-- Choose Account --</option>
                    @foreach($accounts as $account)
                    <option value="{{ $account->id }}">
                        {{ $account->account_no }} - {{ $account->member->user->name }} (Bal: TZS {{ number_format($account->balance, 2) }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Amount (TZS) *</label>
                    <input type="number" name="amount" required min="1" step="0.01" class="input-field w-full rounded-xl border p-2.5 text-sm font-bold" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Preferred Channel *</label>
                    <select name="channel" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Mobile Money">Mobile Money</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Reason for Withdrawal</label>
                <textarea name="reason" rows="3" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
            </div>

            <div class="flex gap-4 pt-6">
                <a href="{{ route('withdrawals.requests') }}" class="flex-1 py-3 rounded-xl border font-bold text-xs text-center">Cancel</a>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-red-600 text-white font-bold text-xs hover:bg-red-500 transition-all">
                    Submit Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
