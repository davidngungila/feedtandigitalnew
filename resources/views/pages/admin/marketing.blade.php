@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Marketing Campaigns</h2>
    <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus"></i> Create Campaign
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Total Reach</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">42.5K</p>
      <p class="text-[10px] text-green-500 font-bold mt-1">+12% this month</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Conversion Rate</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">3.8%</p>
      <p class="text-[10px] text-primary-500 font-bold mt-1">Industry avg: 2.5%</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Active Campaigns</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">4</p>
      <p class="text-[10px] text-blue-500 font-bold mt-1">2 ending soon</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Total Spent</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">$450</p>
      <p class="text-[10px] text-gray-500 mt-1">Budget remaining: $550</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Active Campaigns</h3>
    <div class="space-y-4">
      <div class="p-4 rounded-2xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center text-primary-600 text-xl"><i class="fa-solid fa-gift"></i></div>
          <div>
            <h4 class="text-sm font-bold">New Year Savings Bonus</h4>
            <p class="text-[10px] text-gray-500">Targeting: Dormant Members • Started: 1 May 2024</p>
          </div>
        </div>
        <div class="flex items-center gap-6">
          <div class="text-right">
            <p class="text-xs font-bold">1.2K Clicks</p>
            <p class="text-[9px] text-gray-400">Engagement</p>
          </div>
          <button class="px-3 py-1 rounded-lg border border-primary-500 text-primary-600 text-[10px] font-bold">Analytics</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
