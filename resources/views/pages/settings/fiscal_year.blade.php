@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Fiscal Year Setup</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-calendar-plus mr-2"></i> New Fiscal Year
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Fiscal Year</th>
            <th class="text-left">Start Date</th>
            <th class="text-left">End Date</th>
            <th class="text-left">Status</th>
            <th class="text-left">Current Period</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs font-bold">FY 2026</td>
            <td class="text-xs">01 Jan 2026</td>
            <td class="text-xs">31 Dec 2026</td>
            <td><span class="badge badge-green">Open</span></td>
            <td class="text-xs">May 2026</td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Manage Periods</button>
            </td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">FY 2025</td>
            <td class="text-xs">01 Jan 2025</td>
            <td class="text-xs">31 Dec 2025</td>
            <td><span class="badge badge-gray">Closed</span></td>
            <td class="text-xs">-</td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Archive</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
