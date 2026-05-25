@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Cashbook</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        <i class="fa-solid fa-download mr-2"></i> Export
      </button>
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all shadow-lg shadow-primary-600/20">
        <i class="fa-solid fa-plus mr-2"></i> New Entry
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="card rounded-2xl p-5 border-l-4 border-green-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Cash at Hand</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 4.2M</p>
    </div>
    <div class="card rounded-2xl p-5 border-l-4 border-blue-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Bank Balance</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 125.8M</p>
    </div>
    <div class="card rounded-2xl p-5 border-l-4 border-yellow-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Total Inflow (MTD)</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 15.4M</p>
    </div>
    <div class="card rounded-2xl p-5 border-l-4 border-red-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Total Outflow (MTD)</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 8.2M</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Recent Cash Transactions</h3>
      <div class="flex gap-2">
        <input type="text" placeholder="Search entries..." class="text-xs px-3 py-1.5 rounded-lg border focus:outline-none focus:ring-1 focus:ring-primary-500" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-gray-200'"/>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Date</th>
            <th class="text-left">Ref #</th>
            <th class="text-left">Description</th>
            <th class="text-left">Category</th>
            <th class="text-right">Debit (In)</th>
            <th class="text-right">Credit (Out)</th>
            <th class="text-right">Balance</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs">24 May 2026</td>
            <td class="text-xs font-mono">CB-99281</td>
            <td class="text-xs">Loan Repayment - John Doe</td>
            <td><span class="badge badge-blue">Loan Inflow</span></td>
            <td class="text-right text-xs font-bold text-green-500">150,000</td>
            <td class="text-right text-xs">0</td>
            <td class="text-right text-xs font-bold">4,200,000</td>
          </tr>
          <tr class="table-row">
            <td class="text-xs">24 May 2026</td>
            <td class="text-xs font-mono">CB-99280</td>
            <td class="text-xs">Office Supplies - Stationary</td>
            <td><span class="badge badge-gray">Expense</span></td>
            <td class="text-right text-xs">0</td>
            <td class="text-right text-xs font-bold text-red-500">45,000</td>
            <td class="text-right text-xs font-bold">4,050,000</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
