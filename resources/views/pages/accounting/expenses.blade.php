@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Expense Tracking</h2>
    <button class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> Record Expense
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Total Expenses (MTD)</p>
      <p class="text-2xl font-bold text-red-500">TZS 8.2M</p>
    </div>
    <div class="card rounded-2xl p-5">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Pending Approvals</p>
      <p class="text-2xl font-bold text-yellow-500">4</p>
    </div>
    <div class="card rounded-2xl p-5">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Top Category</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Salaries</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Date</th>
            <th class="text-left">Category</th>
            <th class="text-left">Description</th>
            <th class="text-left">Vendor</th>
            <th class="text-right">Amount</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs">25 May 2026</td>
            <td><span class="badge badge-gray">Utilities</span></td>
            <td class="text-xs">Internet Subscription - May</td>
            <td class="text-xs">Vodacom Tanzania</td>
            <td class="text-right text-xs font-bold">120,000</td>
            <td><span class="badge badge-green">Paid</span></td>
          </tr>
          <tr class="table-row">
            <td class="text-xs">24 May 2026</td>
            <td><span class="badge badge-gray">Admin</span></td>
            <td class="text-xs">Drinking Water Supplies</td>
            <td class="text-xs">Local Supplier</td>
            <td class="text-right text-xs font-bold">45,000</td>
            <td><span class="badge badge-yellow">Pending</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
