@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Write-offs</h2>
    <button class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all">
      Write-off Loan
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Loan ID</th>
            <th class="text-right">Write-off Amount</th>
            <th class="text-left">Reason</th>
            <th class="text-left">Approved By</th>
            <th class="text-left">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-[10px] font-bold">SM</div>
                <span class="text-xs font-semibold">Said Musa</span>
              </div>
            </td>
            <td class="text-xs font-mono">LN-2025-082</td>
            <td class="text-right text-xs font-bold">1,240,000</td>
            <td class="text-xs">Irrecoverable after 365 days</td>
            <td class="text-xs">Board Approval</td>
            <td class="text-xs">12 May 2026</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
