@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     INVESTMENT REPORTS
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Investment Reports</h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-gray-600'">Analytics and performance documentation</p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Report Cards -->
    <div class="card p-6 rounded-2xl hover:border-primary-500 transition-all border" :class="darkMode?'border-[#1a3328]':'border-gray-100'">
      <div class="w-12 h-12 rounded-2xl bg-primary-500/10 text-primary-500 flex items-center justify-center mb-5">
        <i class="fa-solid fa-chart-pie text-xl"></i>
      </div>
      <h3 class="font-bold text-base mb-2" :class="darkMode?'text-white':'text-primary-900'">Portfolio Summary</h3>
      <p class="text-xs mb-6" :class="darkMode?'text-primary-400':'text-gray-500'">Overview of all investment products, active principal, and projected returns.</p>
      <div class="flex gap-2">
        <button class="flex-1 py-2 rounded-xl bg-primary-600 text-white text-[11px] font-bold hover:bg-primary-500 transition-all">Generate PDF</button>
        <button class="px-3 py-2 rounded-xl border" :class="darkMode?'border-[#1a3328] text-primary-400':'border-gray-100 text-gray-500'"><i class="fa-solid fa-file-excel"></i></button>
      </div>
    </div>

    <div class="card p-6 rounded-2xl hover:border-blue-500 transition-all border" :class="darkMode?'border-[#1a3328]':'border-gray-100'">
      <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-500 flex items-center justify-center mb-5">
        <i class="fa-solid fa-calendar-days text-xl"></i>
      </div>
      <h3 class="font-bold text-base mb-2" :class="darkMode?'text-white':'text-primary-900'">Maturity Schedule</h3>
      <p class="text-xs mb-6" :class="darkMode?'text-primary-400':'text-gray-500'">Forecast of investments maturing in the next 30, 60, and 90 days.</p>
      <div class="flex gap-2">
        <button class="flex-1 py-2 rounded-xl bg-blue-600 text-white text-[11px] font-bold hover:bg-blue-500 transition-all">Generate PDF</button>
        <button class="px-3 py-2 rounded-xl border" :class="darkMode?'border-[#1a3328] text-primary-400':'border-gray-100 text-gray-500'"><i class="fa-solid fa-file-excel"></i></button>
      </div>
    </div>

    <div class="card p-6 rounded-2xl hover:border-green-500 transition-all border" :class="darkMode?'border-[#1a3328]':'border-gray-100'">
      <div class="w-12 h-12 rounded-2xl bg-green-500/10 text-green-500 flex items-center justify-center mb-5">
        <i class="fa-solid fa-money-bill-trend-up text-xl"></i>
      </div>
      <h3 class="font-bold text-base mb-2" :class="darkMode?'text-white':'text-primary-900'">Profitability Report</h3>
      <p class="text-xs mb-6" :class="darkMode?'text-primary-400':'text-gray-500'">Detailed breakdown of profit payouts and internal ROI across products.</p>
      <div class="flex gap-2">
        <button class="flex-1 py-2 rounded-xl bg-green-600 text-white text-[11px] font-bold hover:bg-green-500 transition-all">Generate PDF</button>
        <button class="px-3 py-2 rounded-xl border" :class="darkMode?'border-[#1a3328] text-primary-400':'border-gray-100 text-gray-500'"><i class="fa-solid fa-file-excel"></i></button>
      </div>
    </div>
  </div>
</div>
@endsection
