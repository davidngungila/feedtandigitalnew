@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Tax Configuration</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> Add Tax
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Tax Name</th>
            <th class="text-left">Percentage (%)</th>
            <th class="text-left">Tax Code</th>
            <th class="text-left">Applies To</th>
            <th class="text-left">Status</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs font-bold">Value Added Tax (VAT)</td>
            <td class="text-xs">18.0</td>
            <td class="text-xs font-mono">VAT-18</td>
            <td><span class="badge badge-blue">Fees & Services</span></td>
            <td><span class="badge badge-green">Active</span></td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Edit</button>
            </td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Withholding Tax (Savings)</td>
            <td class="text-xs">10.0</td>
            <td class="text-xs font-mono">WHT-SAV</td>
            <td><span class="badge badge-purple">Interest Earned</span></td>
            <td><span class="badge badge-green">Active</span></td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
