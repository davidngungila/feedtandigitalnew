@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     LOAN REPAYMENTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Repayment Tracking</h2>
    <button @click="showModal('repayment')" class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
      <i class="fa-solid fa-plus mr-1.5"></i> Record Payment
    </button>
  </div>

  <!-- Repayment Stats -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5 border-l-4 border-green-500">
      <p class="text-[10px] font-bold uppercase tracking-wider text-primary-500 mb-1">Collected This Month</p>
      <p class="text-2xl font-bold " :class="darkMode?'text-white':'text-primary-900'">TZS 28.4M</p>
    </div>
    <div class="card rounded-2xl p-5 border-l-4 border-yellow-500">
      <p class="text-[10px] font-bold uppercase tracking-wider text-yellow-500 mb-1">Scheduled Repayments</p>
      <p class="text-2xl font-bold " :class="darkMode?'text-white':'text-primary-900'">TZS 42.1M</p>
    </div>
    <div class="card rounded-2xl p-5 border-l-4 border-red-500">
      <p class="text-[10px] font-bold uppercase tracking-wider text-red-500 mb-1">Arrears / Overdue</p>
      <p class="text-2xl font-bold  text-red-500">TZS 5.8M</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Transaction Ref</th>
            <th class="text-left">Member</th>
            <th class="text-left">Loan ID</th>
            <th class="text-right">Amount Paid</th>
            <th class="text-left">Channel</th>
            <th class="text-left">Date</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="t in recentTransactions.filter(t => t.type==='loan-repayment')" :key="t.id">
            <tr class="table-row">
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="t.reference"></td>
              <td>
                <p class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="t.member.user.name"></p>
              </td>
              <td><span class="badge badge-blue text-[10px]" x-text="t.loan ? t.loan.loan_no : 'N/A'"></span></td>
              <td class="text-right  text-xs text-green-500 font-bold" x-text="'TZS ' + parseFloat(t.amount).toLocaleString()"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="t.channel"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="new Date(t.created_at).toLocaleDateString()"></td>
              <td><span class="badge badge-green text-[10px]">Verified</span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
