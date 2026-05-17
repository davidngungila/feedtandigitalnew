@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     SAVING PLANS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Saving & Investment Plans</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
      <i class="fa-solid fa-plus mr-1.5"></i> Create New Plan
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    <template x-for="plan in savingPlans" :key="plan.id">
      <div class="card rounded-2xl p-6 relative overflow-hidden group hover:border-primary-500 transition-all border"
           :class="darkMode?'border-[#1a3328]':'border-primary-100'">
        <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full opacity-5 group-hover:opacity-10 transition-opacity"
             :style="`background:${plan.color}`"></div>
        
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5 text-xl"
             :style="`background:${plan.color}22;color:${plan.color}`">
          <i :class="plan.icon"></i>
        </div>

        <h3 class="font-bold text-base mb-2" :class="darkMode?'text-white':'text-primary-900'" x-text="plan.name"></h3>
        <p class="text-xs mb-5 line-clamp-2" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="plan.desc"></p>

        <div class="grid grid-cols-2 gap-4 mb-6">
          <div class="p-3 rounded-xl" :class="darkMode?'bg-primary-900/20':'bg-primary-50'">
            <p class="text-[10px] font-bold uppercase tracking-wider text-primary-500 mb-1">Interest Rate</p>
            <p class="text-lg font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="plan.rate + '% p.a'"></p>
          </div>
          <div class="p-3 rounded-xl" :class="darkMode?'bg-blue-900/20':'bg-blue-50'">
            <p class="text-[10px] font-bold uppercase tracking-wider text-blue-500 mb-1">Min. Deposit</p>
            <p class="text-lg font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS ' + plan.min.toLocaleString()"></p>
          </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t" :class="darkMode?'border-[#1a3328]':'border-primary-50'">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-clock text-[10px] text-gray-400"></i>
            <span class="text-[11px] font-medium" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="'Term: ' + plan.term"></span>
          </div>
          <button class="text-xs font-bold text-primary-500 hover:text-primary-400 transition-colors">
            Configure <i class="fa-solid fa-chevron-right ml-1"></i>
          </button>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
