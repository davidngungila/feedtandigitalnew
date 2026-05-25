@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Due Date Alerts</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        <i class="fa-solid fa-download mr-2"></i> Export List
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Loan / Item</th>
            <th class="text-left">Amount Due</th>
            <th class="text-left">Due Date</th>
            <th class="text-left">Days Remaining</th>
            <th class="text-left">Status</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold">J</div>
                <span class="text-xs font-semibold">John Doe</span>
              </div>
            </td>
            <td class="text-xs">Personal Loan #1234</td>
            <td class="text-xs font-bold">TZS 150,000</td>
            <td class="text-xs">28 May 2026</td>
            <td><span class="badge badge-yellow text-[10px]">3 Days</span></td>
            <td><span class="badge badge-blue text-[10px]">Pending</span></td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Send SMS</button>
            </td>
          </tr>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold">M</div>
                <span class="text-xs font-semibold">Mary Jane</span>
              </div>
            </td>
            <td class="text-xs">Business Loan #5678</td>
            <td class="text-xs font-bold">TZS 450,000</td>
            <td class="text-xs">24 May 2026</td>
            <td><span class="badge badge-red text-[10px]">Overdue</span></td>
            <td><span class="badge badge-red text-[10px]">Unpaid</span></td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Send Alert</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
