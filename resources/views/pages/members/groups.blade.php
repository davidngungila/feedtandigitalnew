@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Member Groups</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> Create Group
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <template x-for="i in 3">
      <div class="card rounded-2xl p-5 hover:border-primary-500 transition-all border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex justify-between items-start mb-4">
          <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center text-primary-600 text-xl"><i class="fa-solid fa-users-rectangle"></i></div>
          <span class="badge badge-green text-[9px]">Active</span>
        </div>
        <h3 class="font-bold text-sm mb-1">Mwanza Entrepreneurs</h3>
        <p class="text-[10px] text-gray-500 mb-4">12 Members • Created 12 Jan 2026</p>
        <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-primary-900/30">
          <div class="flex -space-x-2">
            <div class="w-6 h-6 rounded-full bg-blue-500 border-2 border-white flex items-center justify-center text-[8px] text-white">A</div>
            <div class="w-6 h-6 rounded-full bg-green-500 border-2 border-white flex items-center justify-center text-[8px] text-white">B</div>
            <div class="w-6 h-6 rounded-full bg-yellow-500 border-2 border-white flex items-center justify-center text-[8px] text-white">C</div>
          </div>
          <button class="text-xs text-primary-600 font-bold hover:underline">View Group</button>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
