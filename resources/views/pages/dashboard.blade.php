@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     DASHBOARD PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">

  <!-- Role-based welcome -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">
        Good morning, <span x-text="currentUser.name ? currentUser.name.split(' ')[0] : ''"></span> 👋
      </h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-primary-600'"
         x-text="getDashboardSubtitle()"></p>
    </div>
    <div class="flex items-center gap-2">
      <span class="text-xs " :class="darkMode?'text-primary-400':'text-primary-500'" x-text="new Date().toLocaleDateString('sw-TZ',{weekday:'long',day:'numeric',month:'long',year:'numeric'})"></span>
    </div>
  </div>

  <!-- KPI Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="kpiCards">
    <template x-for="(card,i) in getDashboardCards()" :key="card.id">
      <div class="stat-card card" :style="`animation-delay:${i*80}ms`" style="animation:fadeIn 0.4s ease both">
        <div class="bg-blob rounded-full" :style="`background:${card.color}`"></div>
        <div class="flex items-start justify-between mb-4">
          <div class="icon-wrap" :style="`background:${card.color}22`">
            <i :class="card.icon" :style="`color:${card.color}`"></i>
          </div>
          <span class="text-xs font-semibold px-2 py-0.5 rounded-full"
                :style="`background:${card.trend>0?'#d1fae5':'#fee2e2'};color:${card.trend>0?'#065f46':'#991b1b'}`">
            <i :class="card.trend>0?'fa-solid fa-arrow-up':'fa-solid fa-arrow-down'" class="text-[10px]"></i>
            <span x-text="Math.abs(card.trend)+'%'"></span>
          </span>
        </div>
        <div>
          <p class="text-[11px] font-semibold uppercase tracking-wider mb-1" :class="darkMode?'text-primary-400':'text-primary-500'" x-text="card.label"></p>
          <p class="text-xl font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="card.value"></p>
          <p class="text-[11px] mt-1" :class="darkMode?'text-primary-500':'text-gray-500'" x-text="card.sub"></p>
        </div>
      </div>
    </template>
  </div>

  <!-- Charts Row -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Loan Disbursement Chart -->
    <div class="card rounded-2xl p-5 lg:col-span-2">
      <div class="flex items-center justify-between mb-4">
        <div>
          <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Loan Disbursements & Collections</h3>
          <p class="text-xs mt-0.5" :class="darkMode?'text-primary-400':'text-gray-500'">Monthly trends — 2024</p>
        </div>
      </div>
      <div class="h-[250px] relative">
        <canvas id="loanChart"></canvas>
      </div>
    </div>

    <!-- Savings Breakdown Pie -->
    <div class="card rounded-2xl p-5">
      <div class="mb-4">
        <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Savings Portfolio</h3>
        <p class="text-xs mt-0.5" :class="darkMode?'text-primary-400':'text-gray-500'">By product type</p>
      </div>
      <div class="h-[180px] relative">
        <canvas id="savingsChart"></canvas>
      </div>
      <div class="mt-4 space-y-2">
        <template x-for="(item,i) in savingPlans.slice(0,5)" :key="i">
          <div class="flex items-center justify-between text-xs">
            <div class="flex items-center gap-2">
              <div class="w-2.5 h-2.5 rounded-sm" :style="`background:${item.color}`"></div>
              <span :class="darkMode?'text-primary-300':'text-gray-600'" x-text="item.name.split(' – ')[0]"></span>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>

  <!-- Second Charts Row -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Member Growth -->
    <div class="card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">Member Growth</h3>
      <div class="h-[180px] relative">
        <canvas id="memberChart"></canvas>
      </div>
    </div>

    <!-- Investment ROI -->
    <div class="card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">Investment ROI</h3>
      <div class="h-[180px] relative">
        <canvas id="investChart"></canvas>
      </div>
    </div>

    <!-- Collection Rate -->
    <div class="card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">Loan Collection Rate</h3>
      <div class="h-[180px] relative">
        <canvas id="collectionChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Recent Transactions + Top Members -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <!-- Recent Transactions -->
    <div class="card rounded-2xl p-5">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Recent Transactions</h3>
        <button @click="navigate('savings-stmt')" class="text-xs text-primary-500 hover:text-primary-400 font-semibold">View All →</button>
      </div>
      <div class="space-y-3">
        <template x-for="tx in recentTransactions.slice(0,7)" :key="tx.id">
          <div class="flex items-center gap-3 p-2.5 rounded-xl transition-colors" :class="darkMode?'hover:bg-primary-900/20':'hover:bg-primary-50'">
            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs flex-shrink-0"
                 :class="tx.type==='deposit'?'bg-green-900/40 text-green-400':tx.type==='withdrawal'?'bg-red-900/40 text-red-400':'bg-blue-900/40 text-blue-400'">
              <i :class="tx.type==='deposit'?'fa-solid fa-arrow-down':tx.type==='withdrawal'?'fa-solid fa-arrow-up':'fa-solid fa-repeat'"></i>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-xs font-semibold truncate" :class="darkMode?'text-white':'text-primary-900'" x-text="tx.member ? tx.member.user.name : 'Unknown'"></p>
              <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="tx.narration || tx.type"></p>
            </div>
            <div class="text-right flex-shrink-0">
              <p class="text-xs font-bold " :class="tx.type==='deposit'?'text-green-500':'text-red-500'"
                 x-text="(tx.type==='deposit'?'+':'-')+'TZS '+tx.amount.toLocaleString()"></p>
              <p class="text-[10px]" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="tx.time"></p>
            </div>
          </div>
        </template>
      </div>
    </div>

    <!-- Pending Approvals (role-based) -->
    <div class="card rounded-2xl p-5">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Pending Approvals</h3>
        <span class="badge badge-yellow" x-text="pendingLoans.filter(l=>l.status==='pending').length+' Pending'"></span>
      </div>
      <div class="space-y-3">
        <template x-for="loan in pendingLoans.slice(0,5)" :key="loan.id">
          <div class="flex items-center gap-3 p-3 rounded-xl border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                 x-text="loan.member ? loan.member.user.name.charAt(0) : '?'"></div>
            <div class="flex-1 min-w-0">
              <p class="text-xs font-semibold truncate" :class="darkMode?'text-white':'text-primary-900'" x-text="loan.member ? loan.member.user.name : 'Unknown'"></p>
              <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">TZS <span x-text="parseFloat(loan.principal).toLocaleString()"></span> • <span x-text="loan.loan_type"></span></p>
            </div>
            <div class="flex items-center gap-2">
              <span class="badge" :class="loan.status==='pending'?'badge-yellow':loan.status==='approved'?'badge-green':'badge-red'" x-text="loan.status"></span>
              <template x-if="(currentUser.role==='admin'||currentUser.role==='manager') && loan.status==='pending'">
                <button @click="approveLoan(loan)" class="w-6 h-6 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-[10px] flex items-center justify-center transition-colors">
                  <i class="fa-solid fa-check"></i>
                </button>
              </template>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>

  <!-- Member Dashboard (only for member role) -->
  <template x-if="currentUser.role==='member'">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">My Savings Summary</h3>
        <div class="space-y-3">
          <template x-for="acc in memberAccounts" :key="acc.id">
            <div class="p-3 rounded-xl border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
              <div class="flex justify-between items-center mb-2">
                <span class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="acc.product_type"></span>
                <span class="badge badge-green" x-text="acc.status"></span>
              </div>
              <p class="text-lg font-bold  text-primary-500">TZS <span x-text="parseFloat(acc.balance).toLocaleString()"></span></p>
              <div class="progress-bar mt-2">
                <div class="progress-fill" :style="`width:${acc.target_amount ? (acc.balance/acc.target_amount*100) : 0}%`"></div>
              </div>
              <p class="text-[11px] mt-1" :class="darkMode?'text-primary-400':'text-gray-500'">Target: TZS <span x-text="parseFloat(acc.target_amount || 0).toLocaleString()"></span></p>
            </div>
          </template>
        </div>
      </div>
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">My Active Loan</h3>
        <template x-if="memberLoan">
          <div>
            <div class="p-4 rounded-xl bg-gradient-to-br from-primary-800 to-primary-900 text-white">
              <p class="text-xs opacity-70 mb-1">Loan Balance</p>
              <p class="text-2xl font-bold ">TZS <span x-text="parseFloat(memberLoan.balance).toLocaleString()"></span></p>
              <div class="grid grid-cols-2 gap-3 mt-4 text-xs">
                <div><p class="opacity-70">Principal</p><p class="font-bold" x-text="'TZS '+parseFloat(memberLoan.principal).toLocaleString()"></p></div>
                <div><p class="opacity-70">Interest Rate</p><p class="font-bold" x-text="memberLoan.interest_rate+'% p.a'"></p></div>
                <div><p class="opacity-70">Next Payment</p><p class="font-bold" x-text="memberLoan.next_due_date"></p></div>
                <div><p class="opacity-70">Installment</p><p class="font-bold" x-text="'TZS '+parseFloat(memberLoan.installment_amount).toLocaleString()"></p></div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </template>
</div>
@endsection
