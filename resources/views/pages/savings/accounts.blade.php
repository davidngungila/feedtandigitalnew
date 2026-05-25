@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     SAVINGS ACCOUNTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Savings Accounts</h2>
    <a href="{{ route('savings.accounts.create') }}" class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
      <i class="fa-solid fa-plus mr-1.5"></i> Open New Account
    </a>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Account No</th>
            <th class="text-left">Member</th>
            <th class="text-left">Product</th>
            <th class="text-right">Balance (TZS)</th>
            <th class="text-left">Opened Date</th>
            <th class="text-left">Status</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($accounts as $account)
          <tr class="table-row">
            <td class="text-xs font-mono font-bold">{{ $account->account_no }}</td>
            <td>
              <div class="flex flex-col">
                <span class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'">{{ $account->member->user->name }}</span>
                <span class="text-[10px] text-gray-500">{{ $account->member->member_no }}</span>
              </div>
            </td>
            <td>
              <span class="badge badge-blue text-[10px]">{{ $account->savingsProduct->name ?? $account->product_type }}</span>
            </td>
            <td class="text-right text-xs font-bold" :class="darkMode?'text-primary-300':'text-primary-900'">
              {{ number_format($account->balance, 2) }}
            </td>
            <td class="text-[11px]">{{ $account->created_at->format('M d, Y') }}</td>
            <td>
              <span class="badge {{ $account->status == 'Active' ? 'badge-green' : 'badge-red' }} text-[10px]">
                {{ $account->status }}
              </span>
            </td>
            <td class="text-right">
              <button class="p-1.5 rounded-lg hover:bg-primary-50 text-primary-600 transition-colors">
                <i class="fa-solid fa-eye"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Advanced Savings Portfolio</h3>
      <div class="flex gap-2">
        <button class="px-3 py-1.5 rounded-lg bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-colors">
          <i class="fa-solid fa-plus mr-1"></i> New Account
        </button>
        <button class="px-3 py-1.5 rounded-lg border text-xs font-semibold transition-colors"
                :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
          <i class="fa-solid fa-file-export mr-1"></i> Export
        </button>
      </div>
    </div>
    
    <!-- Advanced Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="p-4 rounded-2xl border" :class="darkMode?'border-[#1a3328] bg-primary-900/10':'border-primary-100 bg-primary-50/50'">
        <p class="text-[10px] font-bold uppercase tracking-wider text-primary-500 mb-1">Total Savings Portfolio</p>
        <p class="text-xl font-bold " :class="darkMode?'text-white':'text-primary-900'" 
           x-text="'TZS ' + (savingsAccounts.reduce((sum, a) => sum + parseFloat(a.balance), 0)/1000000000).toFixed(2) + 'B'"></p>
      </div>
      <div class="p-4 rounded-2xl border" :class="darkMode?'border-[#1a3328] bg-blue-900/10':'border-blue-100 bg-blue-50/50'">
        <p class="text-[10px] font-bold uppercase tracking-wider text-blue-500 mb-1">Active Accounts</p>
        <p class="text-xl font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="savingsAccounts.length"></p>
      </div>
      <div class="p-4 rounded-2xl border" :class="darkMode?'border-[#1a3328] bg-green-900/10':'border-green-100 bg-green-50/50'">
        <p class="text-[10px] font-bold uppercase tracking-wider text-green-500 mb-1">Avg. Balance</p>
        <p class="text-xl font-bold " :class="darkMode?'text-white':'text-primary-900'"
           x-text="'TZS ' + (savingsAccounts.length ? (savingsAccounts.reduce((sum, a) => sum + parseFloat(a.balance), 0)/savingsAccounts.length/1000000).toFixed(1) : 0) + 'M'"></p>
      </div>
      <div class="p-4 rounded-2xl border" :class="darkMode?'border-[#1a3328] bg-yellow-900/10':'border-yellow-100 bg-yellow-50/50'">
        <p class="text-[10px] font-bold uppercase tracking-wider text-yellow-500 mb-1">Interest Accrued</p>
        <p class="text-xl font-bold " :class="darkMode?'text-white':'text-primary-900'">TZS 12.4M</p>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Member</th>
          <th class="text-left">Account No.</th>
          <th class="text-left">Product</th>
          <th class="text-right">Current Balance</th>
          <th class="text-right">Target</th>
          <th class="text-left">Last Activity</th>
          <th class="text-left">Status</th>
          <th class="text-left">Actions</th>
        </tr></thead>
        <tbody>
          <template x-for="acc in savingsAccounts.slice(0,15)" :key="acc.id">
            <tr class="table-row">
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-7 h-7 rounded-full bg-primary-800 flex items-center justify-center text-primary-300 text-[10px] font-bold"
                       x-text="acc.member && acc.member.user ? acc.member.user.name.charAt(0) : '?'"></div>
                  <div>
                    <p class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="acc.member && acc.member.user ? acc.member.user.name : 'Unknown'"></p>
                    <p class="text-[10px]" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="acc.member ? acc.member.member_no : ''"></p>
                  </div>
                </div>
              </td>
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="acc.account_no"></td>
              <td>
                <div class="flex items-center gap-1.5">
                  <span class="w-2 h-2 rounded-full" :class="acc.product_type==='RDA'?'bg-green-500':acc.product_type==='FLEX'?'bg-blue-500':'bg-yellow-500'"></span>
                  <span class="text-xs font-medium" :class="darkMode?'text-primary-300':'text-primary-700'" x-text="acc.product_type"></span>
                </div>
              </td>
              <td class="text-right  text-xs text-green-500 font-bold" x-text="'TZS '+parseFloat(acc.balance).toLocaleString()"></td>
              <td class="text-right  text-xs" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="acc.target_amount ? 'TZS '+parseFloat(acc.target_amount).toLocaleString() : '-'"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="new Date(acc.updated_at).toLocaleDateString()"></td>
              <td><span class="badge" :class="acc.status==='Active'?'badge-green':'badge-red'" x-text="acc.status"></span></td>
              <td>
                <div class="flex gap-1">
                  <button @click="showModal('savings-details')" class="p-1.5 rounded-lg text-primary-500 hover:bg-primary-900/20 text-[10px]" title="View Statement">
                    <i class="fa-solid fa-list-ul"></i>
                  </button>
                  <button class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-900/20 text-[10px]" title="Deposit">
                    <i class="fa-solid fa-plus-circle"></i>
                  </button>
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
