@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">AI Business Insights</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-blue-600 text-white text-xs font-semibold transition-all shadow-lg shadow-blue-600/20">
        <i class="fa-solid fa-wand-magic-sparkles mr-2"></i> Regenerate Insights
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6 bg-gradient-to-br from-blue-500/5 to-purple-500/5 border border-blue-500/10">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center text-lg"><i class="fa-solid fa-chart-line"></i></div>
        <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Growth Prediction</h3>
      </div>
      <p class="text-xs leading-relaxed" :class="darkMode?'text-primary-400':'text-gray-600'">
        Based on current trends, your loan portfolio is projected to grow by <span class="text-green-500 font-bold">14.2%</span> over the next quarter. We recommend increasing the liquidity buffer in the Arusha branch to meet rising demand.
      </p>
    </div>

    <div class="card rounded-2xl p-6 bg-gradient-to-br from-red-500/5 to-orange-500/5 border border-red-500/10">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 flex items-center justify-center text-lg"><i class="fa-solid fa-shield-virus"></i></div>
        <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Risk Alert</h3>
      </div>
      <p class="text-xs leading-relaxed" :class="darkMode?'text-primary-400':'text-gray-600'">
        AI has detected an <span class="text-red-500 font-bold">8% increase</span> in early-stage delinquency (1-7 days) among small-scale business loans. Consider reviewing the credit scoring model for this product category.
      </p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Optimization Recommendations</h3>
    <div class="space-y-4">
      <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center"><i class="fa-solid fa-percent"></i></div>
          <div>
            <p class="text-sm font-bold">Interest Rate Optimization</p>
            <p class="text-[10px] text-gray-500">Decreasing rates by 0.5% for high-value savers could increase retention by 12%.</p>
          </div>
        </div>
        <button class="px-3 py-1.5 rounded-lg bg-primary-600 text-white text-[10px] font-bold">Apply</button>
      </div>
      <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-users-gear"></i></div>
          <div>
            <p class="text-sm font-bold">Staff Allocation</p>
            <p class="text-[10px] text-gray-500">Mwanza branch is currently understaffed relative to portfolio size. Reallocation suggested.</p>
          </div>
        </div>
        <button class="px-3 py-1.5 rounded-lg bg-primary-600 text-white text-[10px] font-bold">Details</button>
      </div>
    </div>
  </div>
</div>
@endsection
