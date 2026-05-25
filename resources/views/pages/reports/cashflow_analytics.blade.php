@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Cash Flow Analytics</h2>
    <div class="flex gap-2">
      <select class="text-xs px-3 py-1.5 rounded-lg border" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-white border-gray-200'">
        <option>Next 30 Days</option>
        <option>Next 90 Days</option>
        <option>Custom Range</option>
      </select>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-6" :class="darkMode?'text-primary-200':'text-primary-800'">Projected Inflows vs Outflows</h3>
      <div class="h-64 flex items-end justify-between gap-8 px-8">
        <!-- Mock Chart Bars -->
        <div class="flex-1 flex flex-col items-center gap-2">
          <div class="w-full flex gap-1 h-full items-end">
            <div class="flex-1 bg-green-500 rounded-t-lg" style="height: 85%"></div>
            <div class="flex-1 bg-red-500 rounded-t-lg" style="height: 40%"></div>
          </div>
          <span class="text-[10px] font-bold">June</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-2">
          <div class="w-full flex gap-1 h-full items-end">
            <div class="flex-1 bg-green-500 rounded-t-lg" style="height: 70%"></div>
            <div class="flex-1 bg-red-500 rounded-t-lg" style="height: 35%"></div>
          </div>
          <span class="text-[10px] font-bold">July</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-2">
          <div class="w-full flex gap-1 h-full items-end">
            <div class="flex-1 bg-green-500 rounded-t-lg" style="height: 90%"></div>
            <div class="flex-1 bg-red-500 rounded-t-lg" style="height: 50%"></div>
          </div>
          <span class="text-[10px] font-bold">Aug</span>
        </div>
      </div>
      <div class="mt-4 flex justify-center gap-6">
        <div class="flex items-center gap-2"><div class="w-3 h-3 bg-green-500 rounded"></div><span class="text-[10px]">Inflows (Repayments)</span></div>
        <div class="flex items-center gap-2"><div class="w-3 h-3 bg-red-500 rounded"></div><span class="text-[10px]">Outflows (Disbursements/Exp)</span></div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Liquidity Forecast</h3>
      <div class="space-y-4">
        <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-xs font-bold">Estimated Surplus (30d)</p>
            <p class="text-[10px] text-gray-500">Net positive cash position</p>
          </div>
          <p class="text-sm font-bold text-green-500">TZS 12.4M</p>
        </div>
        <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-xs font-bold">Required Liquidity Buffer</p>
            <p class="text-[10px] text-gray-500">Based on withdrawal trends</p>
          </div>
          <p class="text-sm font-bold text-blue-500">TZS 85.0M</p>
        </div>
        <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-xs font-bold">Burn Rate (Monthly)</p>
            <p class="text-[10px] text-gray-500">Average operating expenses</p>
          </div>
          <p class="text-sm font-bold text-red-500">TZS 9.2M</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
