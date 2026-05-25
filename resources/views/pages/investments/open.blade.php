@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     OPEN INVESTMENT
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] max-w-4xl mx-auto">
  <div class="mb-6">
    <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Open New Investment</h2>
    <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-gray-600'">Create a new fixed deposit or wealth plan for a member</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2 space-y-6">
      <div class="card p-6 rounded-2xl">
        <form class="space-y-5">
          <!-- Member Selection -->
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Select Member *</label>
            <div class="relative">
              <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-sm text-primary-500"></i>
              <select class="form-input input-field pl-10" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                <option value="">Choose a member...</option>
                <template x-for="m in members" :key="m.id">
                  <option :value="m.id" x-text="m.user.name + ' (' + m.member_no + ')'"></option>
                </template>
              </select>
            </div>
          </div>

          <!-- Product Selection -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Investment Product *</label>
              <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                <template x-for="p in investmentProducts" :key="p.id">
                  <option :value="p.id" x-text="p.name"></option>
                </template>
              </select>
            </div>
            <div>
              <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Principal Amount (TZS) *</label>
              <input type="number" class="form-input input-field" placeholder="Enter amount" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
            </div>
          </div>

          <!-- Duration and Start Date -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Duration (Months) *</label>
              <input type="number" class="form-input input-field" placeholder="e.g. 12" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
            </div>
            <div>
              <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Start Date *</label>
              <input type="date" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
            </div>
          </div>

          <div class="p-4 rounded-xl border-2 border-dashed" :class="darkMode?'border-primary-900/50 bg-primary-950/20':'border-primary-100 bg-primary-50'">
            <div class="flex items-center gap-3 text-primary-600 mb-2">
              <i class="fa-solid fa-circle-info text-sm"></i>
              <p class="text-xs font-bold uppercase tracking-wider">Investment Preview</p>
            </div>
            <div class="grid grid-cols-2 gap-y-3 text-xs">
              <div :class="darkMode?'text-primary-400':'text-gray-500'">Interest Rate:</div>
              <div class="text-right font-bold" :class="darkMode?'text-white':'text-primary-900'">18.00% p.a</div>
              <div :class="darkMode?'text-primary-400':'text-gray-500'">Maturity Date:</div>
              <div class="text-right font-bold" :class="darkMode?'text-white':'text-primary-900'">25 May 2027</div>
              <div :class="darkMode?'text-primary-400':'text-gray-500'">Expected Profit:</div>
              <div class="text-right font-bold text-green-500">TZS 1,800,000</div>
              <div :class="darkMode?'text-primary-400':'text-gray-500'">Total Payout:</div>
              <div class="text-right font-bold text-primary-500">TZS 11,800,000</div>
            </div>
          </div>

          <div class="flex gap-3 pt-2">
            <button type="button" class="flex-1 py-3 rounded-xl border font-semibold text-sm transition-all" :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/20':'border-primary-200 text-primary-700 hover:bg-primary-50'">
              Save as Draft
            </button>
            <button type="submit" class="flex-1 py-3 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-semibold text-sm transition-all shadow-lg shadow-primary-600/20">
              Confirm & Open
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Info Sidebar -->
    <div class="space-y-6">
      <div class="card p-5 rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 text-white">
        <h3 class="font-bold text-sm mb-4">Investment Rules</h3>
        <ul class="space-y-3 text-xs">
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-circle-check mt-0.5 opacity-70"></i>
            <span>Funds must be available in member's savings account or deposited separately.</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-circle-check mt-0.5 opacity-70"></i>
            <span>Early withdrawal may attract a penalty of 5% on principal.</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fa-solid fa-circle-check mt-0.5 opacity-70"></i>
            <span>Interest is calculated on a pro-rata basis.</span>
          </li>
        </ul>
      </div>

      <div class="card p-5 rounded-2xl">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-white':'text-primary-900'">Member Summary</h3>
        <div class="text-center py-4">
          <div class="w-16 h-16 rounded-full bg-primary-100 mx-auto flex items-center justify-center text-primary-600 text-xl font-bold mb-3">?</div>
          <p class="text-xs italic" :class="darkMode?'text-primary-500':'text-gray-400'">Select a member to view their financial standing</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
