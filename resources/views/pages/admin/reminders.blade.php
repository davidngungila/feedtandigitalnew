@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Payment Reminders & Alerts</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all shadow-lg shadow-primary-600/20">
      <i class="fa-solid fa-plus mr-2"></i> New Reminder
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5 border-l-4 border-yellow-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Upcoming Due</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">124</p>
      <p class="text-[10px] text-yellow-600 mt-1">Due in next 7 days</p>
    </div>
    <div class="card rounded-2xl p-5 border-l-4 border-red-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Overdue</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">45</p>
      <p class="text-[10px] text-red-600 mt-1">Requires immediate attention</p>
    </div>
    <div class="card rounded-2xl p-5 border-l-4 border-green-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Auto-Reminders</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Active</p>
      <p class="text-[10px] text-green-600 mt-1">System automated</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Active Reminder Schedules</h3>
    <div class="space-y-4">
      <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-blue-500/10 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-clock"></i></div>
          <div>
            <p class="text-sm font-bold">3 Days Before Due Date</p>
            <p class="text-[10px] text-gray-500">Channel: SMS & Email • Recipients: All active borrowers</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <button class="text-primary-600 hover:text-primary-500 text-xs font-bold">Edit</button>
          <div class="w-px h-4 bg-gray-200"></div>
          <button class="text-red-500 hover:text-red-400 text-xs font-bold">Disable</button>
        </div>
      </div>
      <div class="p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center"><i class="fa-solid fa-triangle-exclamation"></i></div>
          <div>
            <p class="text-sm font-bold">1 Day After Overdue</p>
            <p class="text-[10px] text-gray-500">Channel: SMS • Recipients: Defaulting members</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <button class="text-primary-600 hover:text-primary-500 text-xs font-bold">Edit</button>
          <div class="w-px h-4 bg-gray-200"></div>
          <button class="text-red-500 hover:text-red-400 text-xs font-bold">Disable</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
