@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     ACTIVE LOANS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Active Loans</h2>
    <div class="flex gap-2">
      <button @click="navigate('loan-apply')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-plus"></i> New Loan
      </button>
    </div>
  </div>

  <!-- Loan Summary Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
    <div class="card rounded-xl p-4">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Active Loans</p>
      <p class="text-xl font-bold  mt-1" :class="darkMode?'text-white':'text-primary-900'">247</p>
    </div>
    <div class="card rounded-xl p-4">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Total Disbursed</p>
      <p class="text-xl font-bold  mt-1 text-primary-500">1.82B</p>
    </div>
    <div class="card rounded-xl p-4">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Total Outstanding</p>
      <p class="text-xl font-bold  mt-1 text-yellow-500">987.5M</p>
    </div>
    <div class="card rounded-xl p-4">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Overdue</p>
      <p class="text-xl font-bold  mt-1 text-red-500">18</p>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="flex flex-col sm:flex-row gap-3 mb-4">
      <input type="text" placeholder="Search loans..." class="form-input input-field text-xs py-2 flex-1"
             :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
      <select class="form-input input-field text-xs py-2 w-full sm:w-auto"
              :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
        <option>All Types</option><option>Emergency</option><option>Development</option><option>Business</option>
      </select>
    </div>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Member</th>
          <th class="text-left">Loan Type</th>
          <th class="text-right">Principal</th>
          <th class="text-right">Interest</th>
          <th class="text-right">Balance</th>
          <th class="text-left">Installment</th>
          <th class="text-left">Due Date</th>
          <th class="text-left">Status</th>
          <th class="text-left">Actions</th>
        </tr></thead>
        <tbody>
          <template x-for="loan in activeLoans.slice(0,12)" :key="loan.id">
            <tr class="table-row">
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-7 h-7 rounded-full bg-primary-800 flex items-center justify-center text-primary-300 text-xs font-bold" x-text="loan.member.charAt(0)"></div>
                  <div>
                    <p class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="loan.member"></p>
                    <p class="text-[10px]" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="loan.id"></p>
                  </div>
                </div>
              </td>
              <td><span class="badge badge-blue text-[10px]" x-text="loan.type"></span></td>
              <td class="text-right  text-xs" :class="darkMode?'text-primary-300':'text-gray-700'" x-text="loan.principal.toLocaleString()"></td>
              <td class="text-right  text-xs text-yellow-500" x-text="loan.interest.toLocaleString()"></td>
              <td class="text-right  text-xs font-bold text-red-500" x-text="loan.balance.toLocaleString()"></td>
              <td class="text-xs" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="'TZS '+loan.installment.toLocaleString()"></td>
              <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="loan.dueDate"></td>
              <td><span class="badge" :class="loan.status==='Current'?'badge-green':loan.status==='Overdue'?'badge-red':'badge-yellow'" x-text="loan.status"></span></td>
              <td>
                <div class="flex items-center gap-1">
                  <button class="p-1.5 rounded-lg text-primary-500 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-[11px]"><i class="fa-solid fa-eye"></i></button>
                  <button @click="showModal('repayment')" class="p-1.5 rounded-lg text-green-500 hover:bg-green-100 dark:hover:bg-green-900/30 text-[11px]"><i class="fa-solid fa-money-bill"></i></button>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
