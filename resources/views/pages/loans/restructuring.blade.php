@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Restructuring</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      New Restructure Request
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Original Term</th>
            <th class="text-left">New Term</th>
            <th class="text-right">New Monthly</th>
            <th class="text-left">Reason</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold">JD</div>
                <span class="text-xs font-semibold">John Doe</span>
              </div>
            </td>
            <td class="text-xs">12 Months</td>
            <td class="text-xs">24 Months</td>
            <td class="text-right text-xs font-bold">75,000</td>
            <td class="text-xs">Financial Hardship</td>
            <td><span class="badge badge-yellow">Under Review</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
