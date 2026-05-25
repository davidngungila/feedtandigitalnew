@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Regulatory Reporting</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-file-export mr-2"></i> Generate BOT Report
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Required Regulatory Filings</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="p-4 rounded-xl border flex flex-col justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div>
          <h4 class="text-sm font-bold">Bank of Tanzania (BOT)</h4>
          <p class="text-[10px] text-gray-500 mt-1">Monthly microfinance statistical return</p>
        </div>
        <div class="mt-4 flex justify-between items-center">
          <span class="badge badge-green">UP TO DATE</span>
          <button class="text-xs text-primary-600 font-bold hover:underline">View</button>
        </div>
      </div>
      <div class="p-4 rounded-xl border flex flex-col justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div>
          <h4 class="text-sm font-bold">Financial Intelligence Unit (FIU)</h4>
          <p class="text-[10px] text-gray-500 mt-1">Suspicious Transaction Reports (STR)</p>
        </div>
        <div class="mt-4 flex justify-between items-center">
          <span class="badge badge-yellow">1 PENDING</span>
          <button class="text-xs text-primary-600 font-bold hover:underline">Review</button>
        </div>
      </div>
      <div class="p-4 rounded-xl border flex flex-col justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div>
          <h4 class="text-sm font-bold">TRA Tax Returns</h4>
          <p class="text-[10px] text-gray-500 mt-1">Quarterly corporate tax and VAT filings</p>
        </div>
        <div class="mt-4 flex justify-between items-center">
          <span class="badge badge-blue">DUE IN 12 DAYS</span>
          <button class="text-xs text-primary-600 font-bold hover:underline">Prepare</button>
        </div>
      </div>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Submission History</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Report Name</th>
            <th class="text-left">Period</th>
            <th class="text-left">Submitted At</th>
            <th class="text-left">Status</th>
            <th class="text-left">Receipt</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs font-bold">BOT Monthly Return</td>
            <td class="text-xs">April 2026</td>
            <td class="text-[11px]">02 May 2026</td>
            <td><span class="badge badge-green">Accepted</span></td>
            <td><i class="fa-solid fa-file-invoice text-primary-500 cursor-pointer"></i></td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">FIU CTR Report</td>
            <td class="text-xs">Q1 2026</td>
            <td class="text-[11px]">10 April 2026</td>
            <td><span class="badge badge-green">Accepted</span></td>
            <td><i class="fa-solid fa-file-invoice text-primary-500 cursor-pointer"></i></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
