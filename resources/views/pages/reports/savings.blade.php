@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     SAVINGS REPORTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Savings Reports</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
        <i class="fa-solid fa-file-excel mr-1.5"></i> Export Data
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <h3 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-primary-500'">Product Balances</h3>
      <p class="text-xs mb-4" :class="darkMode?'text-primary-300':'text-gray-600'">Total savings held in RDA, FLEX, and other products.</p>
      <button class="w-full py-2 rounded-lg bg-primary-900/10 text-primary-500 text-xs font-bold hover:bg-primary-900/20 transition-all">Generate</button>
    </div>
    <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <h3 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-primary-500'">Interest Accrued</h3>
      <p class="text-xs mb-4" :class="darkMode?'text-primary-300':'text-gray-600'">Report of interest earned by members for the current period.</p>
      <button class="w-full py-2 rounded-lg bg-primary-900/10 text-primary-500 text-xs font-bold hover:bg-primary-900/20 transition-all">Generate</button>
    </div>
    <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <h3 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-primary-500'">Daily Collections</h3>
      <p class="text-xs mb-4" :class="darkMode?'text-primary-300':'text-gray-600'">Daily breakdown of deposits and savings contributions.</p>
      <button class="w-full py-2 rounded-lg bg-primary-900/10 text-primary-500 text-xs font-bold hover:bg-primary-900/20 transition-all">Generate</button>
    </div>
  </div>
</div>
@endsection
