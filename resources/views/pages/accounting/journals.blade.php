@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Journal Entries</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all shadow-lg shadow-primary-600/20">
        <i class="fa-solid fa-plus mr-2"></i> Post Journal
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Date</th>
            <th class="text-left">Journal ID</th>
            <th class="text-left">Narrative</th>
            <th class="text-left">Status</th>
            <th class="text-right">Total Debit</th>
            <th class="text-right">Total Credit</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs">25 May 2026</td>
            <td class="text-xs font-mono">JV-2026-001</td>
            <td class="text-xs">End of month depreciation adjustment</td>
            <td><span class="badge badge-green">Posted</span></td>
            <td class="text-right text-xs font-bold">1,200,000</td>
            <td class="text-right text-xs font-bold">1,200,000</td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">View</button>
            </td>
          </tr>
          <tr class="table-row">
            <td class="text-xs">24 May 2026</td>
            <td class="text-xs font-mono">JV-2026-002</td>
            <td class="text-xs">Accrued interest for May 2026</td>
            <td><span class="badge badge-yellow">Pending</span></td>
            <td class="text-right text-xs font-bold">450,000</td>
            <td class="text-right text-xs font-bold">450,000</td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Post</button>
              <span class="mx-1">|</span>
              <button class="text-red-500 hover:underline text-xs font-bold">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
