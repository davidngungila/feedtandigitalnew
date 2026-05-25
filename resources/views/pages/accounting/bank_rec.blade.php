@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Bank Reconciliation</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        <i class="fa-solid fa-upload mr-2"></i> Import Statement
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Reconciliation Summary</h3>
      <div class="space-y-3">
        <div class="flex justify-between text-xs"><span>Bank Balance (as per Statement)</span><span class="font-mono font-bold">126,450,000</span></div>
        <div class="flex justify-between text-xs"><span>Book Balance (as per System)</span><span class="font-mono font-bold">125,800,000</span></div>
        <div class="flex justify-between text-xs text-red-500 font-bold border-t pt-2"><span>Difference</span><span class="font-mono">650,000</span></div>
      </div>
      <div class="mt-6 p-4 rounded-xl bg-yellow-500/10 border border-yellow-500/20">
        <p class="text-[10px] text-yellow-700 font-bold"><i class="fa-solid fa-circle-info mr-2"></i> Unreconciled Items Detected</p>
        <p class="text-[9px] text-yellow-600 mt-1">There are 3 transactions in the statement not yet matched in the system.</p>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Bank Accounts</h3>
      <div class="space-y-3">
        <div class="p-3 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold text-[10px]">NMB</div>
            <div>
              <p class="text-xs font-bold">NMB Operations</p>
              <p class="text-[9px] text-gray-500">A/C: ****2910</p>
            </div>
          </div>
          <span class="badge badge-green text-[9px]">Matched</span>
        </div>
        <div class="p-3 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center font-bold text-[10px]">CRDB</div>
            <div>
              <p class="text-xs font-bold">CRDB Savings</p>
              <p class="text-[9px] text-gray-500">A/C: ****8832</p>
            </div>
          </div>
          <span class="badge badge-yellow text-[9px]">3 Pending</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
