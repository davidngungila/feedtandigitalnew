@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     PAYMENTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Mobile Money Integration</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <template x-for="provider in paymentProviders" :key="provider.id">
      <div class="card rounded-2xl p-5">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold text-white" :style="`background:${provider.color}`"
                 x-text="provider.code"></div>
            <div>
              <p class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="provider.name"></p>
              <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="provider.desc"></p>
            </div>
          </div>
          <span class="badge" :class="provider.active?'badge-green':'badge-red'" x-text="provider.active?'Active':'Inactive'"></span>
        </div>
        <div class="grid grid-cols-2 gap-3 text-center">
          <div class="p-2.5 rounded-xl" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
            <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'">Today</p>
            <p class="font-bold text-sm " :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS '+provider.today.toLocaleString()"></p>
          </div>
          <div class="p-2.5 rounded-xl" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
            <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'">This Month</p>
            <p class="font-bold text-sm " :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS '+(provider.month/1000000).toFixed(1)+'M'"></p>
          </div>
        </div>
        <button class="mt-3 w-full py-2 rounded-xl text-xs font-semibold transition-colors"
                :class="provider.active?'bg-primary-600 hover:bg-primary-500 text-white':'border border-gray-500 text-gray-400'">
          <span x-text="provider.active?'Manage Integration':'Enable Integration'"></span>
        </button>
      </div>
    </template>
  </div>
</div>
@endsection
