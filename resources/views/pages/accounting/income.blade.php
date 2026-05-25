@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Income Tracking</h2>
    <button class="px-4 py-2 rounded-xl bg-green-600 hover:bg-green-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> Record Income
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Total Income (MTD)</p>
      <p class="text-2xl font-bold text-green-600">TZS 18.4M</p>
    </div>
    <div class="card rounded-2xl p-5">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Interest Income</p>
      <p class="text-2xl font-bold text-blue-600">TZS 15.4M</p>
    </div>
    <div class="card rounded-2xl p-5">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Other Fees</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 3.0M</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Date</th>
            <th class="text-left">Type</th>
            <th class="text-left">Source</th>
            <th class="text-left">Description</th>
            <th class="text-right">Amount</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs">25 May 2026</td>
            <td><span class="badge badge-blue">Loan Interest</span></td>
            <td class="text-xs">Member #9928</td>
            <td class="text-xs">Monthly interest repayment</td>
            <td class="text-right text-xs font-bold text-green-600">45,000</td>
            <td><span class="badge badge-green">Received</span></td>
          </tr>
          <tr class="table-row">
            <td class="text-xs">24 May 2026</td>
            <td><span class="badge badge-yellow">Fees</span></td>
            <td class="text-xs">New Member #10021</td>
            <td class="text-xs">Registration and passbook fee</td>
            <td class="text-right text-xs font-bold text-green-600">25,000</td>
            <td><span class="badge badge-green">Received</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
