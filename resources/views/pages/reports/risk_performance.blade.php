@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     RISK & PERFORMANCE REPORTS
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="activePage==='report-risk'?'Default Risk Analysis':'Daily Cash Flow'"></h2>
  </div>

  <!-- Cash Flow Report -->
  <div x-show="activePage==='report-cashflow'" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="card rounded-2xl p-5 border-l-4 border-green-500">
        <p class="text-[10px] font-bold text-gray-500 uppercase">Inflow (Today)</p>
        <p class="text-xl font-bold">TZS 12.4M</p>
      </div>
      <div class="card rounded-2xl p-5 border-l-4 border-red-500">
        <p class="text-[10px] font-bold text-gray-500 uppercase">Outflow (Today)</p>
        <p class="text-xl font-bold">TZS 8.2M</p>
      </div>
      <div class="card rounded-2xl p-5 border-l-4 border-primary-500">
        <p class="text-[10px] font-bold text-gray-500 uppercase">Net Position</p>
        <p class="text-xl font-bold">TZS 4.2M</p>
      </div>
    </div>
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4">Cash Flow Activity</h3>
      <table class="data-table">
        <thead>
          <tr>
            <th>Time</th><th>Category</th><th>Description</th><th class="text-right">Amount</th><th>Method</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-[10px]">09:15 AM</td><td><span class="badge badge-green">Inflow</span></td><td class="text-xs">Loan Repayment - LN0012</td><td class="text-right font-bold text-xs">+ TZS 150,000</td><td>M-Pesa</td>
          </tr>
          <tr class="table-row">
            <td class="text-[10px]">10:30 AM</td><td><span class="badge badge-red">Outflow</span></td><td class="text-xs">Loan Disbursement - LN0088</td><td class="text-right font-bold text-xs">- TZS 1,500,000</td><td>Bank</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Risk Report -->
  <div x-show="activePage==='report-risk'" class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-6">Default Risk Analysis (PAR)</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
      <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900/20">
        <p class="text-[10px] font-bold text-gray-500 mb-1">PAR 1-30 Days</p>
        <p class="text-lg font-bold text-yellow-500">4.2%</p>
      </div>
      <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900/20">
        <p class="text-[10px] font-bold text-gray-500 mb-1">PAR 31-60 Days</p>
        <p class="text-lg font-bold text-orange-500">2.1%</p>
      </div>
      <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900/20">
        <p class="text-[10px] font-bold text-gray-500 mb-1">PAR 61-90 Days</p>
        <p class="text-lg font-bold text-red-500">0.8%</p>
      </div>
      <div class="text-center p-4 rounded-xl bg-gray-50 dark:bg-gray-900/20">
        <p class="text-[10px] font-bold text-gray-500 mb-1">Total Risk Exposure</p>
        <p class="text-lg font-bold text-red-600">TZS 42.5M</p>
      </div>
    </div>
    <button class="px-6 py-2 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-500">Generate Delinquency List</button>
  </div>
</div>
@endsection
