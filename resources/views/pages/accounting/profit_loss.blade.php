@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Profit & Loss Statement</h2>
    <div class="flex gap-2">
      <select class="text-xs px-3 py-1.5 rounded-lg border" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-white border-gray-200'">
        <option>Financial Year 2026</option>
        <option>Q1 2026</option>
        <option>Q2 2026</option>
      </select>
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        Download Report
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-8 max-w-4xl mx-auto shadow-xl">
    <div class="text-center mb-8 border-b pb-6">
      <h3 class="text-xl font-bold uppercase" :class="darkMode?'text-white':'text-primary-900'">Feedtan Digital Microfinance</h3>
      <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Statement of Profit or Loss</p>
      <p class="text-[10px] text-gray-400 mt-1">For the period ended 31 May 2026</p>
    </div>

    <div class="space-y-6">
      <!-- Income Section -->
      <div>
        <h4 class="text-sm font-bold border-b pb-2 mb-3 text-primary-600 uppercase">Operating Income</h4>
        <div class="space-y-2">
          <div class="flex justify-between text-sm">
            <span>Interest Income on Loans</span>
            <span class="font-mono">15,450,000</span>
          </div>
          <div class="flex justify-between text-sm">
            <span>Processing Fees</span>
            <span class="font-mono">2,100,000</span>
          </div>
          <div class="flex justify-between text-sm">
            <span>Membership Fees</span>
            <span class="font-mono">850,000</span>
          </div>
          <div class="flex justify-between text-sm font-bold pt-2 border-t mt-2">
            <span>TOTAL INCOME</span>
            <span class="font-mono border-b-2 border-double border-primary-900 dark:border-white">18,400,000</span>
          </div>
        </div>
      </div>

      <!-- Expenses Section -->
      <div>
        <h4 class="text-sm font-bold border-b pb-2 mb-3 text-red-500 uppercase">Operating Expenses</h4>
        <div class="space-y-2">
          <div class="flex justify-between text-sm">
            <span>Interest Expense on Savings</span>
            <span class="font-mono">(4,200,000)</span>
          </div>
          <div class="flex justify-between text-sm">
            <span>Salaries and Wages</span>
            <span class="font-mono">(3,500,000)</span>
          </div>
          <div class="flex justify-between text-sm">
            <span>Office Rent & Utilities</span>
            <span class="font-mono">(1,200,000)</span>
          </div>
          <div class="flex justify-between text-sm">
            <span>Depreciation</span>
            <span class="font-mono">(450,000)</span>
          </div>
          <div class="flex justify-between text-sm font-bold pt-2 border-t mt-2">
            <span>TOTAL EXPENSES</span>
            <span class="font-mono">(9,350,000)</span>
          </div>
        </div>
      </div>

      <!-- Net Profit Section -->
      <div class="pt-6 border-t-4 border-primary-600">
        <div class="flex justify-between text-lg font-bold">
          <span>NET PROFIT / (LOSS)</span>
          <span class="font-mono text-green-500">9,050,000</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
