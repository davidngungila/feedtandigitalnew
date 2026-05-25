@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Penalty Rules</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> Add Rule
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Rule Name</th>
            <th class="text-left">Trigger</th>
            <th class="text-left">Calculation Type</th>
            <th class="text-right">Value</th>
            <th class="text-left">Grace Period</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs font-bold">Late Repayment Penalty</td>
            <td class="text-xs">1 Day after due date</td>
            <td><span class="badge badge-blue">Fixed Amount</span></td>
            <td class="text-right text-xs">TZS 5,000 / Day</td>
            <td class="text-xs">3 Days</td>
            <td><span class="badge badge-green">Active</span></td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Default Penalty</td>
            <td class="text-xs">30 Days after due date</td>
            <td><span class="badge badge-purple">Percentage of O/S</span></td>
            <td class="text-right text-xs">2% of Balance</td>
            <td class="text-xs">None</td>
            <td><span class="badge badge-green">Active</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
