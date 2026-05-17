@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     SAVINGS - DEPOSIT MONEY PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Deposit Money</h2>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Deposit Form -->
    <div class="card rounded-2xl p-6 lg:col-span-2 space-y-4">
      <h3 class="font-bold text-sm mb-2" :class="darkMode?'text-primary-200':'text-primary-800'">New Deposit Transaction</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Member *</label>
          <input type="text" class="form-input input-field" placeholder="Search member name or phone..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Account / Product *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>RDA – Regular Deposit Account</option>
            <option>Emergency Savings Fund</option>
            <option>FLEX – Flexible Savings</option>
            <option>SWF – Share Welfare Fund</option>
            <option>Share Capital</option>
          </select>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Amount (TZS) *</label>
          <input type="number" class="form-input input-field" placeholder="0.00" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Payment Channel *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Cash</option><option>M-Pesa</option><option>Airtel Money</option>
            <option>TigoPesa</option><option>HaloPesa</option><option>Bank Transfer</option>
          </select>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Transaction Date *</label>
          <input type="date" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Reference Number</label>
          <input type="text" class="form-input input-field" placeholder="Auto-generated" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div class="md:col-span-2">
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Narration</label>
          <textarea rows="2" class="form-input input-field" placeholder="Deposit narration..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
        </div>
      </div>
      <div class="flex justify-end gap-3">
        <button class="px-6 py-2.5 rounded-xl border text-xs font-semibold transition-colors"
                :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">Reset</button>
        <button @click="showToast('Deposit processed successfully! Receipt generated.','success')"
                class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
          <i class="fa-solid fa-money-bill-transfer mr-2"></i> Process Deposit
        </button>
      </div>
    </div>

    <!-- Quick Summary -->
    <div class="space-y-4">
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-4" :class="darkMode?'text-primary-300':'text-primary-700'">Today's Deposits</h3>
        <div class="space-y-3">
          <div>
            <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Total Collected</p>
            <p class="text-xl font-bold  text-primary-500">TZS 48,750,000</p>
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div class="p-2.5 rounded-xl" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
              <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'">Transactions</p>
              <p class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">127</p>
            </div>
            <div class="p-2.5 rounded-xl" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
              <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'">Via Mobile</p>
              <p class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">89</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-3" :class="darkMode?'text-primary-300':'text-primary-700'">Channel Breakdown</h3>
        <div class="space-y-2.5">
          <template x-for="ch in depositChannels" :key="ch.name">
            <div>
              <div class="flex justify-between text-[11px] mb-1">
                <span :class="darkMode?'text-primary-300':'text-gray-600'" x-text="ch.name"></span>
                <span class="font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="ch.pct+'%'"></span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" :style="`width:${ch.pct}%`"></div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Deposits Table -->
  <div class="card rounded-2xl p-5">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Recent Deposit Transactions</h3>
      <div class="flex gap-2">
        <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors"
                :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">
          <i class="fa-solid fa-file-pdf"></i> PDF
        </button>
        <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors"
                :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">
          <i class="fa-solid fa-file-excel"></i> Excel
        </button>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Member</th>
          <th class="text-left">Product</th>
          <th class="text-left">Reference</th>
          <th class="text-left">Channel</th>
          <th class="text-right">Amount (TZS)</th>
          <th class="text-right">Balance (TZS)</th>
          <th class="text-left">Date</th>
          <th class="text-left">Status</th>
        </tr></thead>
        <tbody>
          <template x-for="d in recentTransactions.filter(t => t.type==='deposit').slice(0,15)" :key="d.id">
            <tr class="table-row">
              <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="d.member && d.member.user ? d.member.user.name : 'Unknown'"></td>
              <td><span class="badge badge-blue text-[10px]" x-text="d.savings_account ? d.savings_account.product_type : 'Deposit'"></span></td>
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="d.reference"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="d.channel"></td>
              <td class="text-right  text-xs font-semibold text-green-500" x-text="'TZS '+parseFloat(d.amount).toLocaleString()"></td>
              <td class="text-right  text-xs" :class="darkMode?'text-primary-300':'text-gray-700'" x-text="'TZS '+parseFloat(d.balance_after).toLocaleString()"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="new Date(d.created_at).toLocaleDateString()"></td>
              <td><span class="badge badge-green text-[10px]">Completed</span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
