@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     PROFIT PAYMENTS
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Profit Payments</h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-gray-600'">History of profit distributions to members</p>
    </div>
    <div class="flex gap-2">
      <button class="flex items-center gap-2 px-4 py-2 rounded-xl border text-xs font-semibold transition-colors" :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        <i class="fa-solid fa-download"></i> Export CSV
      </button>
      <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all shadow-lg shadow-primary-600/20">
        <i class="fa-solid fa-money-bill-transfer"></i> Bulk Payout
      </button>
    </div>
  </div>

  <!-- Payout Summary -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card p-5 rounded-2xl border-l-4 border-primary-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Total Profits Paid</p>
      <p class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 124.5M</p>
    </div>
    <div class="card p-5 rounded-2xl border-l-4 border-yellow-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Pending Payouts</p>
      <p class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 12.8M</p>
    </div>
    <div class="card p-5 rounded-2xl border-l-4 border-blue-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Next Batch Date</p>
      <p class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">01 June 2026</p>
    </div>
  </div>

  <div class="card rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Date</th>
            <th class="text-left">Reference</th>
            <th class="text-left">Member</th>
            <th class="text-left">Investment</th>
            <th class="text-right">Amount</th>
            <th class="text-left">Method</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="pay in profitPayments" :key="pay.id">
            <tr class="table-row">
              <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="pay.date"></td>
              <td class="text-xs font-mono font-bold text-primary-600" x-text="pay.ref"></td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center text-[10px] text-primary-600 font-bold" x-text="pay.member_name.charAt(0)"></div>
                  <span class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="pay.member_name"></span>
                </div>
              </td>
              <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-600'" x-text="pay.inv_ref"></td>
              <td class="text-right text-xs font-bold text-green-500" x-text="'TZS ' + pay.amount.toLocaleString()"></td>
              <td class="text-xs" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="pay.method"></td>
              <td class="text-center"><span class="badge badge-green">Success</span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
