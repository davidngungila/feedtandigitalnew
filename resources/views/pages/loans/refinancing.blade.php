@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Refinancing</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Top-up Loan
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Existing Balance</th>
            <th class="text-left">New Principal</th>
            <th class="text-left">Net Disbursement</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold">MJ</div>
                <span class="text-xs font-semibold">Mary Jane</span>
              </div>
            </td>
            <td class="text-xs">450,000</td>
            <td class="text-xs">2,000,000</td>
            <td class="text-xs font-bold">1,550,000</td>
            <td><span class="badge badge-green">Completed</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
