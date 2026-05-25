@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Balance Sheet</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-print mr-2"></i> Print Statement
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-8 max-w-4xl mx-auto">
    <div class="text-center mb-8 border-b pb-6">
      <h3 class="text-xl font-bold uppercase" :class="darkMode?'text-white':'text-primary-900'">Feedtan Digital Microfinance</h3>
      <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Statement of Financial Position</p>
      <p class="text-[10px] text-gray-400 mt-1">As at 31 May 2026</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
      <!-- Assets -->
      <div class="space-y-6">
        <h4 class="text-sm font-bold border-b pb-2 text-primary-600 uppercase">Assets</h4>
        
        <div>
          <p class="text-xs font-bold text-gray-500 mb-2">Non-Current Assets</p>
          <div class="space-y-1 pl-2">
            <div class="flex justify-between text-xs"><span>Office Equipment</span><span class="font-mono">12,500,000</span></div>
            <div class="flex justify-between text-xs"><span>Less: Acc. Depreciation</span><span class="font-mono text-red-500">(1,250,000)</span></div>
          </div>
        </div>

        <div>
          <p class="text-xs font-bold text-gray-500 mb-2">Current Assets</p>
          <div class="space-y-1 pl-2">
            <div class="flex justify-between text-xs"><span>Cash and Bank</span><span class="font-mono">125,800,000</span></div>
            <div class="flex justify-between text-xs"><span>Loan Portfolio</span><span class="font-mono">850,450,000</span></div>
            <div class="flex justify-between text-xs"><span>Other Receivables</span><span class="font-mono">2,100,000</span></div>
          </div>
        </div>

        <div class="flex justify-between text-sm font-bold pt-4 border-t-2">
          <span>TOTAL ASSETS</span>
          <span class="font-mono border-b-4 border-double">989,600,000</span>
        </div>
      </div>

      <!-- Liabilities & Equity -->
      <div class="space-y-6">
        <h4 class="text-sm font-bold border-b pb-2 text-primary-600 uppercase">Liabilities & Equity</h4>
        
        <div>
          <p class="text-xs font-bold text-gray-500 mb-2">Current Liabilities</p>
          <div class="space-y-1 pl-2">
            <div class="flex justify-between text-xs"><span>Member Savings</span><span class="font-mono">742,300,000</span></div>
            <div class="flex justify-between text-xs"><span>Accounts Payable</span><span class="font-mono">8,250,000</span></div>
          </div>
        </div>

        <div>
          <p class="text-xs font-bold text-gray-500 mb-2">Equity</p>
          <div class="space-y-1 pl-2">
            <div class="flex justify-between text-xs"><span>Share Capital</span><span class="font-mono">200,000,000</span></div>
            <div class="flex justify-between text-xs"><span>Retained Earnings</span><span class="font-mono">30,000,000</span></div>
            <div class="flex justify-between text-xs text-green-500 font-bold"><span>Current Period Profit</span><span class="font-mono">9,050,000</span></div>
          </div>
        </div>

        <div class="flex justify-between text-sm font-bold pt-4 border-t-2">
          <span>TOTAL LIABILITIES & EQUITY</span>
          <span class="font-mono border-b-4 border-double">989,600,000</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
