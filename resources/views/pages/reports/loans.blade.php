@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     LOAN REPORTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Reports</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
        <i class="fa-solid fa-chart-line mr-1.5"></i> Analysis
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <h3 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-primary-500'">Disbursement Report</h3>
      <p class="text-xs mb-4" :class="darkMode?'text-primary-300':'text-gray-600'">List of loans issued within a specific date range.</p>
      <button class="w-full py-2 rounded-lg bg-primary-900/10 text-primary-500 text-xs font-bold hover:bg-primary-900/20 transition-all">Generate</button>
    </div>
    <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <h3 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-primary-500'">Arrears / Delinquency</h3>
      <p class="text-xs mb-4" :class="darkMode?'text-primary-300':'text-gray-600'">Report on overdue loans and expected repayments.</p>
      <button class="w-full py-2 rounded-lg bg-primary-900/10 text-primary-500 text-xs font-bold hover:bg-primary-900/20 transition-all">Generate</button>
    </div>
    <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <h3 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-primary-500'">Collection Rate</h3>
      <p class="text-xs mb-4" :class="darkMode?'text-primary-300':'text-gray-600'">Summary of collection efficiency across different loan products.</p>
      <button class="w-full py-2 rounded-lg bg-primary-900/10 text-primary-500 text-xs font-bold hover:bg-primary-900/20 transition-all">Generate</button>
    </div>
  </div>
</div>
@endsection
