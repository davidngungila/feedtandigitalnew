@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MEMBER STATEMENTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Member Statements</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
        <i class="fa-solid fa-file-pdf mr-1.5"></i> Batch Export
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <!-- Filter Bar -->
    <div class="flex flex-col md:flex-row gap-4 mb-6">
      <div class="flex-1 relative">
        <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
        <input type="text" placeholder="Search member by name or number..." 
               class="form-input input-field pl-9 text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-100'"/>
      </div>
      <div class="flex gap-2">
        <input type="date" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-100'"/>
        <input type="date" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-100'"/>
        <button class="px-4 py-2 rounded-xl border text-xs font-semibold" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-100 text-primary-700'">Filter</button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Account Type</th>
            <th class="text-right">Opening Balance</th>
            <th class="text-right">Total Deposits</th>
            <th class="text-right">Total Withdrawals</th>
            <th class="text-right">Closing Balance</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="m in members.slice(0,10)" :key="m.id">
            <tr class="table-row">
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-7 h-7 rounded-full bg-primary-800 flex items-center justify-center text-primary-300 text-[10px] font-bold" x-text="m.user.name.charAt(0)"></div>
                  <div>
                    <p class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="m.user.name"></p>
                    <p class="text-[10px]" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="m.member_no"></p>
                  </div>
                </div>
              </td>
              <td><span class="badge badge-blue text-[10px]">RDA Account</span></td>
              <td class="text-right  text-xs" :class="darkMode?'text-primary-400':'text-gray-600'">TZS 1,200,000</td>
              <td class="text-right  text-xs text-green-500 font-semibold">TZS 850,000</td>
              <td class="text-right  text-xs text-red-500 font-semibold">TZS 200,000</td>
              <td class="text-right  text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'">TZS 1,850,000</td>
              <td>
                <button @click="showToast('Generating statement...','info')" class="p-1.5 rounded-lg text-primary-500 hover:bg-primary-900/20 text-[10px]">
                  <i class="fa-solid fa-download"></i>
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
