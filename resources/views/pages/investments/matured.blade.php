@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MATURED INVESTMENTS
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Matured Investments</h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-gray-600'">Plans that have completed their duration</p>
    </div>
  </div>

  <div class="card rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Reference</th>
            <th class="text-left">Member</th>
            <th class="text-right">Principal</th>
            <th class="text-right">Total Profit</th>
            <th class="text-right">Total Payout</th>
            <th class="text-left">Maturity Date</th>
            <th class="text-center">Status</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="inv in activeInvestments.filter(i => i.status === 'matured')" :key="inv.id">
            <tr class="table-row group">
              <td class="text-xs font-mono font-bold text-primary-600" x-text="inv.ref"></td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-7 h-7 rounded-full bg-primary-600 flex items-center justify-center text-[10px] text-white font-bold" x-text="inv.member_name.charAt(0)"></div>
                  <span class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="inv.member_name"></span>
                </div>
              </td>
              <td class="text-right text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS ' + inv.principal.toLocaleString()"></td>
              <td class="text-right text-xs font-bold text-green-500" x-text="'TZS ' + inv.accrued.toLocaleString()"></td>
              <td class="text-right text-xs font-bold text-primary-500" x-text="'TZS ' + (inv.principal + inv.accrued).toLocaleString()"></td>
              <td class="text-xs" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="inv.maturity_date"></td>
              <td class="text-center"><span class="badge badge-yellow" x-text="inv.status"></span></td>
              <td class="text-right">
                <button class="px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-[10px] font-semibold transition-all shadow-lg shadow-primary-600/20">
                  Process Payout
                </button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
