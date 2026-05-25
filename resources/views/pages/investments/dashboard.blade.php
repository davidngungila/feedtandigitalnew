@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     INVESTMENT DASHBOARD
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">

  <!-- Header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Investment Dashboard</h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-primary-600'">Portfolio performance and growth tracking</p>
    </div>
    <button @click="navigate('investments-open')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-all shadow-lg shadow-primary-600/20">
      <i class="fa-solid fa-plus"></i> New Investment
    </button>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="card p-5 rounded-2xl relative overflow-hidden group">
      <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary-500/10 rounded-full transition-transform group-hover:scale-110"></div>
      <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Total Portfolio</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 2.45B</p>
      <div class="flex items-center gap-1 mt-2 text-[10px] text-green-500 font-bold">
        <i class="fa-solid fa-arrow-up"></i> 12.5% vs last month
      </div>
    </div>
    <div class="card p-5 rounded-2xl relative overflow-hidden group">
      <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-500/10 rounded-full transition-transform group-hover:scale-110"></div>
      <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Active Investments</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">156</p>
      <div class="flex items-center gap-1 mt-2 text-[10px] text-blue-500 font-bold">
        <i class="fa-solid fa-chart-line"></i> 8 new this week
      </div>
    </div>
    <div class="card p-5 rounded-2xl relative overflow-hidden group">
      <div class="absolute -right-4 -top-4 w-24 h-24 bg-yellow-500/10 rounded-full transition-transform group-hover:scale-110"></div>
      <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Accrued Profit</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 42.8M</p>
      <div class="flex items-center gap-1 mt-2 text-[10px] text-yellow-500 font-bold">
        <i class="fa-solid fa-coins"></i> Pending payout
      </div>
    </div>
    <div class="card p-5 rounded-2xl relative overflow-hidden group">
      <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-500/10 rounded-full transition-transform group-hover:scale-110"></div>
      <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Maturity (30 Days)</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 185.0M</p>
      <div class="flex items-center gap-1 mt-2 text-[10px] text-red-500 font-bold">
        <i class="fa-solid fa-calendar-check"></i> 12 accounts
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Chart -->
    <div class="card p-6 rounded-2xl lg:col-span-2">
      <div class="flex items-center justify-between mb-6">
        <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Investment Growth & Returns</h3>
        <select class="text-xs bg-transparent border-none focus:ring-0" :class="darkMode?'text-primary-400':'text-gray-500'">
          <option>Last 6 Months</option>
          <option>Last Year</option>
        </select>
      </div>
      <div class="h-[300px] relative">
        <canvas id="investmentDashboardChart"></canvas>
      </div>
    </div>

    <!-- Product Breakdown -->
    <div class="card p-6 rounded-2xl">
      <h3 class="font-bold text-sm mb-6" :class="darkMode?'text-white':'text-primary-900'">Portfolio Allocation</h3>
      <div class="h-[200px] relative mb-6">
        <canvas id="investmentAllocationChart"></canvas>
      </div>
      <div class="space-y-3">
        <template x-for="prod in investmentProducts.slice(0, 4)" :key="prod.id">
          <div class="flex items-center justify-between text-xs">
            <div class="flex items-center gap-2">
              <div class="w-2 h-2 rounded-full" :style="`background: ${prod.color}`"></div>
              <span :class="darkMode?'text-primary-300':'text-gray-600'" x-text="prod.name"></span>
            </div>
            <span class="font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="prod.allocation + '%'"></span>
          </div>
        </template>
      </div>
    </div>
  </div>

  <!-- Recent Activity -->
  <div class="card rounded-2xl overflow-hidden">
    <div class="p-5 border-b" :class="darkMode?'border-[#1a3328]':'border-gray-100'">
      <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Recent Investment Activity</h3>
    </div>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Product</th>
            <th class="text-left">Principal</th>
            <th class="text-left">Rate</th>
            <th class="text-left">Date</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="inv in activeInvestments.slice(0, 5)" :key="inv.id">
            <tr class="table-row">
              <td class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-primary-600 flex items-center justify-center text-[10px] text-white font-bold" x-text="inv.member_name.charAt(0)"></div>
                <span class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="inv.member_name"></span>
              </td>
              <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-600'" x-text="inv.product_name"></td>
              <td class="text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS ' + inv.principal.toLocaleString()"></td>
              <td class="text-xs text-primary-500 font-bold" x-text="inv.rate + '%'"></td>
              <td class="text-xs" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="inv.start_date"></td>
              <td><span class="badge badge-green" x-text="inv.status"></span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
