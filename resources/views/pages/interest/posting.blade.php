@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Interest Posting</h2>
    </div>

    <div class="card rounded-2xl p-6 max-w-2xl">
        <div class="mb-6 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
                <div class="text-xs text-blue-700 leading-relaxed">
                    Interest posting calculates and adds interest to member accounts based on the product's rate and rules. 
                    This process is irreversible. Ensure you have selected the correct period.
                </div>
            </div>
        </div>

        <form action="{{ route('interest.posting.process') }}" method="POST" class="space-y-6" onsubmit="return confirm('Start interest posting for the selected product and period?')">
            @csrf
            <div>
                <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Select Savings Product *</label>
                <select name="savings_product_id" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                    <option value="">-- Choose Product --</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->interest_rate }}% p.a)</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Period Start Date *</label>
                    <input type="date" name="period_start" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label font-bold text-xs mb-2 block" :class="darkMode?'text-primary-300':'text-primary-700'">Period End Date *</label>
                    <input type="date" name="period_end" required class="input-field w-full rounded-xl border p-2.5 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-3 rounded-xl bg-primary-900 text-white font-bold text-xs hover:bg-black transition-all">
                    <i class="fa-solid fa-calculator mr-2"></i> Run Interest Posting
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
