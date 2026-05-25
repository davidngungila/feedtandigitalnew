@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Collateral Management</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> Add Collateral
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Item Type</th>
            <th class="text-left">Description</th>
            <th class="text-right">Estimated Value</th>
            <th class="text-left">Status</th>
            <th class="text-left">Actions</th>
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
            <td class="text-xs">Motor Vehicle</td>
            <td class="text-xs">Toyota IST - Reg # T123 ABC</td>
            <td class="text-right text-xs font-bold">TZS 12,000,000</td>
            <td><span class="badge badge-blue">Held by Branch</span></td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">View Docs</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
