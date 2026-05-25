@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Guarantor Management</h2>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Guarantor</th>
            <th class="text-left">Guaranteed Loan</th>
            <th class="text-left">Amount</th>
            <th class="text-left">Exposure</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold">BK</div>
                <span class="text-xs font-semibold">Bakari Kombo</span>
              </div>
            </td>
            <td class="text-xs">John Doe (LN-2026-102)</td>
            <td class="text-xs font-bold">TZS 1,500,000</td>
            <td>
              <div class="w-24 bg-gray-100 dark:bg-primary-900/30 rounded-full h-1.5">
                <div class="bg-yellow-500 h-1.5 rounded-full" style="width: 45%"></div>
              </div>
            </td>
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
