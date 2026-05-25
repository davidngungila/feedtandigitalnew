@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Trial Balance</h2>
    <div class="flex gap-2">
      <input type="date" class="text-xs px-3 py-1.5 rounded-lg border" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-white border-gray-200'"/>
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        Generate
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Account Name</th>
            <th class="text-left">Account Code</th>
            <th class="text-right">Debit Balance</th>
            <th class="text-right">Credit Balance</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs font-bold">Cash at Bank</td>
            <td class="text-xs font-mono">1001</td>
            <td class="text-right text-xs">125,800,000</td>
            <td class="text-right text-xs">0</td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Loan Portfolio</td>
            <td class="text-xs font-mono">1005</td>
            <td class="text-right text-xs">850,450,000</td>
            <td class="text-right text-xs">0</td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Savings Liability</td>
            <td class="text-xs font-mono">2001</td>
            <td class="text-right text-xs">0</td>
            <td class="text-right text-xs">742,300,000</td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Share Capital</td>
            <td class="text-xs font-mono">3001</td>
            <td class="text-right text-xs">0</td>
            <td class="text-right text-xs">200,000,000</td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="bg-primary-50 dark:bg-primary-900/20">
            <td colspan="2" class="text-sm font-bold p-3">TOTALS</td>
            <td class="text-right text-sm font-bold p-3">976,250,000</td>
            <td class="text-right text-sm font-bold p-3">976,250,000</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endsection
