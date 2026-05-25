@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Interest Rules</h2>
        <button @click="showModal = true" class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
            <i class="fa-solid fa-plus mr-1.5"></i> Add Rule
        </button>
    </div>

    <div class="card rounded-2xl p-5">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">Product</th>
                        <th class="text-left">Rule Name</th>
                        <th class="text-right">Rate (%)</th>
                        <th class="text-right">Min Amount</th>
                        <th class="text-left">Effective Date</th>
                        <th class="text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rules as $rule)
                    <tr class="table-row">
                        <td class="text-xs font-bold">{{ $rule->savingsProduct->name }}</td>
                        <td class="text-xs">{{ $rule->rule_name }}</td>
                        <td class="text-right text-xs font-bold">{{ $rule->interest_rate }}%</td>
                        <td class="text-right text-xs">{{ number_format($rule->min_amount, 2) }}</td>
                        <td class="text-xs">{{ $rule->effective_date }}</td>
                        <td>
                            <span class="badge {{ $rule->is_active ? 'badge-green' : 'badge-red' }} text-[10px]">
                                {{ $rule->is_active ? 'Active' : 'Expired' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @if($rules->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500 text-xs italic">No interest rules defined.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Rule Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-cloak>
        <div class="card rounded-2xl p-6 w-full max-w-md shadow-2xl" @click.away="showModal = false">
            <h3 class="text-lg font-bold mb-4">New Interest Rule</h3>
            <form action="{{ route('interest.rules.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-xs font-bold mb-1 block">Savings Product *</label>
                    <select name="savings_product_id" required class="w-full rounded-xl border p-2 text-sm">
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold mb-1 block">Rule Name *</label>
                    <input type="text" name="rule_name" required class="w-full rounded-xl border p-2 text-sm" placeholder="e.g. Standard Interest">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold mb-1 block">Interest Rate (%) *</label>
                        <input type="number" step="0.01" name="interest_rate" required class="w-full rounded-xl border p-2 text-sm">
                    </div>
                    <div>
                        <label class="text-xs font-bold mb-1 block">Min Amount *</label>
                        <input type="number" name="min_amount" value="0" required class="w-full rounded-xl border p-2 text-sm">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-bold mb-1 block">Effective Date *</label>
                    <input type="date" name="effective_date" required class="w-full rounded-xl border p-2 text-sm">
                </div>
                <div class="flex gap-2 pt-4">
                    <button type="button" @click="showModal = false" class="flex-1 py-2 rounded-xl border font-bold text-xs">Cancel</button>
                    <button type="submit" class="flex-1 py-2 rounded-xl bg-primary-600 text-white font-bold text-xs">Save Rule</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
