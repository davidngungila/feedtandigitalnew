@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Interest Configuration</h2>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Dynamic Interest Rules</h3>
    <div class="space-y-4">
      <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div>
          <p class="text-sm font-bold">Loyalty Discount</p>
          <p class="text-[10px] text-gray-500">Reduce interest by 1% for members with > 2 years history</p>
        </div>
        <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
      </div>
      <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div>
          <p class="text-sm font-bold">Group Loan Subsidy</p>
          <p class="text-[10px] text-gray-500">Reduce interest by 2% for registered entrepreneurial groups</p>
        </div>
        <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
      </div>
    </div>
  </div>
</div>
@endsection
