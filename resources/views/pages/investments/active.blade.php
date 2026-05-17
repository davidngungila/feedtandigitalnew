@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     INVESTMENTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Active Investments</h2>
    <button @click="showModal('addInvestment')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus"></i> New Investment
    </button>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
    <div class="card rounded-xl p-4">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Total Invested</p>
      <p class="text-xl font-bold  mt-1" :class="darkMode?'text-white':'text-primary-900'">TZS 3.4B</p>
    </div>
    <div class="card rounded-xl p-4">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Total ROI</p>
      <p class="text-xl font-bold  mt-1 text-primary-500">TZS 612M</p>
    </div>
    <div class="card rounded-xl p-4">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Active Plans</p>
      <p class="text-xl font-bold  mt-1 text-blue-500">48</p>
    </div>
    <div class="card rounded-xl p-4">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Maturing Soon</p>
      <p class="text-xl font-bold  mt-1 text-yellow-500">7</p>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Member</th><th class="text-left">Plan</th>
          <th class="text-right">Principal</th><th class="text-right">ROI %</th>
          <th class="text-right">Returns</th><th class="text-left">Start</th>
          <th class="text-left">Maturity</th><th class="text-left">Status</th>
        </tr></thead>
        <tbody>
          <template x-for="inv in investments.slice(0,12)" :key="inv.id">
            <tr class="table-row">
              <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="inv.member"></td>
              <td><span class="badge badge-blue text-[10px]" x-text="inv.plan"></span></td>
              <td class="text-right  text-xs" :class="darkMode?'text-primary-300':'text-gray-700'" x-text="'TZS '+inv.principal.toLocaleString()"></td>
              <td class="text-right  text-xs text-primary-500 font-bold" x-text="inv.roi+'%'"></td>
              <td class="text-right  text-xs text-green-500" x-text="'TZS '+inv.returns.toLocaleString()"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="inv.start"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="inv.maturity"></td>
              <td><span class="badge" :class="inv.status==='Active'?'badge-green':inv.status==='Matured'?'badge-blue':'badge-yellow'" x-text="inv.status"></span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
