@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     INVESTMENT PRODUCTS
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Investment Products</h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-gray-600'">Available fixed deposit and investment plans</p>
    </div>
    <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-all shadow-lg shadow-primary-600/20">
      <i class="fa-solid fa-plus"></i> Add Product
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <template x-for="prod in investmentProducts" :key="prod.id">
      <div class="card rounded-2xl overflow-hidden group hover:border-primary-500/50 transition-all border" :class="darkMode?'border-[#1a3328]':'border-gray-100'">
        <div class="p-6">
          <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-transform group-hover:scale-110" :style="`background: ${prod.color}22; color: ${prod.color}`">
              <i :class="prod.icon" class="text-xl"></i>
            </div>
            <span class="badge badge-green" x-show="prod.active">Active</span>
          </div>
          <h3 class="font-bold text-base mb-2" :class="darkMode?'text-white':'text-primary-900'" x-text="prod.name"></h3>
          <p class="text-xs mb-6 line-clamp-2" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="prod.description"></p>
          
          <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="p-3 rounded-xl" :class="darkMode?'bg-primary-900/20':'bg-primary-50'">
              <p class="text-[10px] uppercase font-bold text-primary-500 mb-1">Interest Rate</p>
              <p class="text-sm font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="prod.rate + '% p.a'"></p>
            </div>
            <div class="p-3 rounded-xl" :class="darkMode?'bg-blue-900/20':'bg-blue-50'">
              <p class="text-[10px] uppercase font-bold text-blue-500 mb-1">Min. Amount</p>
              <p class="text-sm font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS ' + prod.min_amount.toLocaleString()"></p>
            </div>
          </div>

          <div class="flex items-center justify-between text-[11px] mb-6" :class="darkMode?'text-primary-400':'text-gray-500'">
            <div class="flex items-center gap-1.5">
              <i class="fa-solid fa-clock"></i>
              <span x-text="'Min ' + prod.duration + ' Months'"></span>
            </div>
            <div class="flex items-center gap-1.5">
              <i class="fa-solid fa-rotate"></i>
              <span x-text="prod.payout"></span>
            </div>
          </div>

          <div class="flex gap-2">
            <button class="flex-1 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
              Edit Product
            </button>
            <button class="px-3 py-2.5 rounded-xl border hover:bg-red-50 hover:text-red-500 transition-all" :class="darkMode?'border-[#1a3328] text-primary-400':'border-gray-100 text-gray-500'">
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </div>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
