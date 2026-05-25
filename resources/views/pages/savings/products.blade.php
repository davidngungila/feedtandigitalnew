@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Savings Products</h2>
        <button @click="showModal = true" class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
            <i class="fa-solid fa-plus mr-1.5"></i> Create Product
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="card rounded-2xl p-6 border relative overflow-hidden group hover:border-primary-500 transition-all"
             :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-primary-500/10 text-primary-500 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-piggy-bank"></i>
                </div>
                <span class="badge badge-green text-xs">{{ $product->interest_rate }}% p.a</span>
            </div>
            <h3 class="font-bold text-lg mb-1" :class="darkMode?'text-white':'text-primary-900'">{{ $product->name }}</h3>
            <p class="text-xs font-mono mb-3" :class="darkMode?'text-primary-400':'text-primary-500'">{{ $product->code }}</p>
            <p class="text-xs mb-4 line-clamp-2" :class="darkMode?'text-primary-300':'text-gray-600'">{{ $product->description }}</p>
            
            <div class="grid grid-cols-2 gap-4 pt-4 border-t" :class="darkMode?'border-[#1a3328]':'border-primary-50'">
                <div>
                    <p class="text-[9px] uppercase font-bold text-gray-400">Min Balance</p>
                    <p class="text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS {{ number_format($product->min_balance, 2) }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase font-bold text-gray-400">Frequency</p>
                    <p class="text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ ucfirst($product->interest_posting_frequency) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Create Product Modal (Simplified) -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-cloak>
        <div class="card rounded-2xl p-6 w-full max-w-md shadow-2xl" @click.away="showModal = false">
            <h3 class="text-lg font-bold mb-4">New Savings Product</h3>
            <form action="{{ route('savings.products.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-xs font-bold mb-1 block">Product Name</label>
                    <input type="text" name="name" required class="w-full rounded-xl border p-2 text-sm">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold mb-1 block">Code</label>
                        <input type="text" name="code" required class="w-full rounded-xl border p-2 text-sm">
                    </div>
                    <div>
                        <label class="text-xs font-bold mb-1 block">Interest Rate (%)</label>
                        <input type="number" step="0.01" name="interest_rate" required class="w-full rounded-xl border p-2 text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold mb-1 block">Min Balance</label>
                        <input type="number" name="min_balance" required class="w-full rounded-xl border p-2 text-sm">
                    </div>
                    <div>
                        <label class="text-xs font-bold mb-1 block">Method</label>
                        <select name="interest_calculation_method" class="w-full rounded-xl border p-2 text-sm">
                            <option value="daily">Daily Balance</option>
                            <option value="monthly">Monthly Average</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-bold mb-1 block">Posting Frequency</label>
                    <select name="interest_posting_frequency" class="w-full rounded-xl border p-2 text-sm">
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                <div class="flex gap-2 pt-4">
                    <button type="button" @click="showModal = false" class="flex-1 py-2 rounded-xl border font-bold text-xs">Cancel</button>
                    <button type="submit" class="flex-1 py-2 rounded-xl bg-primary-600 text-white font-bold text-xs">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
