@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     ACCOUNTING – GENERAL LEDGER
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">General Ledger</h2>
    <div class="flex gap-2">
      <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-600 hover:bg-primary-500 text-white transition-all">
        <i class="fa-solid fa-file-pdf"></i> PDF
      </button>
      <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">
        <i class="fa-solid fa-print"></i> Print
      </button>
    </div>
  </div>

  <!-- Balance Overview -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-xl p-4 border-l-4 border-green-500">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Total Assets</p>
      <p class="text-2xl font-bold  mt-1 text-green-500">TZS 8.74B</p>
    </div>
    <div class="card rounded-xl p-4 border-l-4 border-red-500">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Total Liabilities</p>
      <p class="text-2xl font-bold  mt-1 text-red-500">TZS 5.12B</p>
    </div>
    <div class="card rounded-xl p-4 border-l-4 border-blue-500">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Members' Equity</p>
      <p class="text-2xl font-bold  mt-1 text-blue-500">TZS 3.62B</p>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Account Code</th><th class="text-left">Account Name</th>
          <th class="text-left">Category</th><th class="text-right">Debit (TZS)</th>
          <th class="text-right">Credit (TZS)</th><th class="text-right">Balance (TZS)</th>
        </tr></thead>
        <tbody>
          <template x-for="entry in ledgerEntries" :key="entry.code">
            <tr class="table-row">
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="entry.code"></td>
              <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="entry.name"></td>
              <td><span class="badge text-[10px]" :class="entry.cat==='Asset'?'badge-green':entry.cat==='Liability'?'badge-red':entry.cat==='Income'?'badge-blue':'badge-yellow'" x-text="entry.cat"></span></td>
              <td class="text-right  text-xs" :class="darkMode?'text-primary-300':'text-gray-700'" x-text="entry.debit.toLocaleString()"></td>
              <td class="text-right  text-xs" :class="darkMode?'text-primary-300':'text-gray-700'" x-text="entry.credit.toLocaleString()"></td>
              <td class="text-right  text-xs font-bold" :class="entry.balance>=0?'text-green-500':'text-red-500'" x-text="entry.balance.toLocaleString()"></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
