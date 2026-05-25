@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Products Setup</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> New Product
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-6 hover:border-primary-500 transition-all border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
      <div class="flex justify-between items-start mb-4">
        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 text-xl"><i class="fa-solid fa-user"></i></div>
        <span class="badge badge-green text-[9px]">Active</span>
      </div>
      <h3 class="font-bold text-sm mb-1">Personal Loan</h3>
      <p class="text-[10px] text-gray-500 mb-4">Rate: 18% Annual • Max: 5M TZS</p>
      <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-primary-900/30">
        <span class="text-[10px] font-bold">124 Active Loans</span>
        <button class="text-xs text-primary-600 font-bold hover:underline">Edit Product</button>
      </div>
    </div>
    <div class="card rounded-2xl p-6 hover:border-primary-500 transition-all border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
      <div class="flex justify-between items-start mb-4">
        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-600 text-xl"><i class="fa-solid fa-briefcase"></i></div>
        <span class="badge badge-green text-[9px]">Active</span>
      </div>
      <h3 class="font-bold text-sm mb-1">Business Loan</h3>
      <p class="text-[10px] text-gray-500 mb-4">Rate: 15% Annual • Max: 50M TZS</p>
      <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-primary-900/30">
        <span class="text-[10px] font-bold">45 Active Loans</span>
        <button class="text-xs text-primary-600 font-bold hover:underline">Edit Product</button>
      </div>
    </div>
  </div>
</div>
@endsection
