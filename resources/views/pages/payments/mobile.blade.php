@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MOBILE PAYMENTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Mobile Payments</h2>
  </div>

  <!-- Initiate Payment Tab -->
  <div x-show="activePage==='payment-initiate'" class="card rounded-2xl p-6 max-w-2xl">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Initiate New Payment</h3>
    <div class="space-y-4">
      <div>
        <label class="form-label">Select Member</label>
        <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
          <option>Search member...</option>
          <template x-for="m in members" :key="m.id">
            <option x-text="m.user.name + ' (' + m.member_no + ')'"></option>
          </template>
        </select>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="form-label">Payment Type</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
            <option>Savings Deposit</option>
            <option>Loan Repayment</option>
            <option>Share Purchase</option>
            <option>Registration Fee</option>
          </select>
        </div>
        <div>
          <label class="form-label">Amount (TZS)</label>
          <input type="number" class="form-input input-field" placeholder="0.00" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
        </div>
      </div>
      <div>
        <label class="form-label">Payment Provider</label>
        <div class="grid grid-cols-3 gap-3">
          <button class="p-3 rounded-xl border-2 border-primary-500 bg-primary-50 dark:bg-primary-900/20 flex flex-col items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold">M</div>
            <span class="text-[10px] font-bold">M-Pesa</span>
          </button>
          <button class="p-3 rounded-xl border-2 border-transparent bg-gray-50 dark:bg-gray-800/20 flex flex-col items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white text-xs font-bold">A</div>
            <span class="text-[10px] font-bold">Airtel Money</span>
          </button>
          <button class="p-3 rounded-xl border-2 border-transparent bg-gray-50 dark:bg-gray-800/20 flex flex-col items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-bold">T</div>
            <span class="text-[10px] font-bold">Tigo Pesa</span>
          </button>
        </div>
      </div>
      <button @click="showToast('Payment request sent to member phone', 'success')" class="w-full py-3 rounded-xl bg-primary-600 text-white font-bold text-sm hover:bg-primary-500 transition-all">
        Send Push Prompt (STK)
      </button>
    </div>
  </div>

  <!-- All Payments Tab -->
  <div x-show="activePage==='payment-all'" x-data="{ payTab: 'success' }" class="space-y-4">
    <div class="flex items-center gap-2 p-1 rounded-xl w-fit" :class="darkMode?'bg-primary-900/20':'bg-primary-50'">
      <button @click="payTab='success'" class="px-4 py-2 rounded-lg text-xs font-bold transition-all" :class="payTab==='success'?(darkMode?'bg-primary-800 text-white':'bg-white text-primary-900 shadow-sm'):'text-primary-500'">Successful</button>
      <button @click="payTab='failed'" class="px-4 py-2 rounded-lg text-xs font-bold transition-all" :class="payTab==='failed'?(darkMode?'bg-primary-800 text-white':'bg-white text-primary-900 shadow-sm'):'text-primary-500'">Failed</button>
    </div>

    <div class="card rounded-2xl overflow-hidden">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Reference</th>
            <th class="text-left">Provider</th>
            <th class="text-right">Amount</th>
            <th class="text-left">Date</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <template x-if="payTab==='success'">
            <template x-for="i in 5">
              <tr class="table-row">
                <td class="text-xs font-bold">John Doe</td>
                <td class="text-[10px] font-mono">MP240516.0001</td>
                <td><span class="badge badge-green">M-Pesa</span></td>
                <td class="text-right text-xs font-bold">TZS 50,000</td>
                <td class="text-[10px]">16 May 2024, 09:12</td>
                <td><span class="badge badge-green">Completed</span></td>
              </tr>
            </template>
          </template>
          <template x-if="payTab==='failed'">
            <template x-for="i in 3">
              <tr class="table-row">
                <td class="text-xs font-bold">Jane Smith</td>
                <td class="text-[10px] font-mono">AM240516.0882</td>
                <td><span class="badge badge-red">Airtel</span></td>
                <td class="text-right text-xs font-bold">TZS 120,000</td>
                <td class="text-[10px]">15 May 2024, 14:45</td>
                <td><span class="badge badge-red">Cancelled</span></td>
              </tr>
            </template>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
