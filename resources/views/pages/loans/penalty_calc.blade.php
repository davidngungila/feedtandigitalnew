@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Penalty Calculations</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Run Auto-Calculate
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Loan ID</th>
            <th class="text-right">Overdue Principal</th>
            <th class="text-left">Days Overdue</th>
            <th class="text-right">Penalty Amount</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-[10px] font-bold">AK</div>
                <span class="text-xs font-semibold">Amos Kibet</span>
              </div>
            </td>
            <td class="text-xs font-mono">LN-2026-442</td>
            <td class="text-right text-xs">850,000</td>
            <td class="text-xs">42 Days</td>
            <td class="text-right text-xs font-bold text-red-500">210,000</td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Waive Penalty</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
