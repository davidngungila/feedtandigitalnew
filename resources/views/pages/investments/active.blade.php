@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     ACTIVE INVESTMENTS
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Active Investments</h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-gray-600'">Currently running wealth and fixed deposit plans</p>
    </div>
    <div class="flex gap-2">
      <div class="relative">
        <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-xs text-primary-500"></i>
        <input type="text" placeholder="Search reference or member..." class="form-input input-field pl-9 text-xs py-2 w-64" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-white border-primary-200'"/>
      </div>
      <button class="p-2 rounded-xl border transition-colors" :class="darkMode?'border-[#1a3328] text-primary-400 hover:bg-primary-900/30':'border-primary-200 text-primary-600 hover:bg-primary-50'">
        <i class="fa-solid fa-filter"></i>
      </button>
    </div>
  </div>

  <div class="card rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Reference</th>
            <th class="text-left">Member</th>
            <th class="text-left">Investment Plan</th>
            <th class="text-right">Principal</th>
            <th class="text-center">Rate</th>
            <th class="text-left">Maturity Date</th>
            <th class="text-right">Accrued Profit</th>
            <th class="text-center">Status</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="inv in activeInvestments" :key="inv.id">
            <tr class="table-row group">
              <td class="text-xs font-mono font-bold text-primary-600" x-text="inv.ref"></td>
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-7 h-7 rounded-full bg-primary-600 flex items-center justify-center text-[10px] text-white font-bold" x-text="inv.member_name.charAt(0)"></div>
                  <span class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="inv.member_name"></span>
                </div>
              </td>
              <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-600'" x-text="inv.product_name"></td>
              <td class="text-right text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS ' + inv.principal.toLocaleString()"></td>
              <td class="text-center text-xs text-primary-500 font-bold" x-text="inv.rate + '%'"></td>
              <td class="text-xs" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="inv.maturity_date"></td>
              <td class="text-right text-xs font-bold text-green-500" x-text="'TZS ' + inv.accrued.toLocaleString()"></td>
              <td class="text-center"><span class="badge badge-green" x-text="inv.status"></span></td>
              <td class="text-right">
                <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                  <button class="w-8 h-8 rounded-lg flex items-center justify-center bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white transition-all dark:bg-primary-900/30">
                    <i class="fa-solid fa-eye text-[10px]"></i>
                  </button>
                  <button class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all dark:bg-blue-900/30">
                    <i class="fa-solid fa-certificate text-[10px]"></i>
                  </button>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <div class="p-4 border-t flex items-center justify-between" :class="darkMode?'border-[#1a3328]':'border-gray-100'">
      <p class="text-[11px]" :class="darkMode?'text-primary-500':'text-gray-400'">Showing 1 to 10 of 156 entries</p>
      <div class="flex gap-1">
        <button class="p-2 rounded-lg border text-[10px] disabled:opacity-50" :class="darkMode?'border-[#1a3328]':'border-gray-200'" disabled>Previous</button>
        <button class="p-2 rounded-lg bg-primary-600 text-white text-[10px] px-3">1</button>
        <button class="p-2 rounded-lg border text-[10px]" :class="darkMode?'border-[#1a3328]':'border-gray-200'">2</button>
        <button class="p-2 rounded-lg border text-[10px]" :class="darkMode?'border-[#1a3328]':'border-gray-200'">Next</button>
      </div>
    </div>
  </div>
</div>
@endsection
