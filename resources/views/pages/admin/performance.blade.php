@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Staff Targets & Performance</h2>
    <div class="flex gap-2">
      <select class="px-3 py-1.5 rounded-xl border text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-white border-gray-200'">
        <option>This Month</option>
        <option>Last Month</option>
        <option>Quarterly</option>
      </select>
      <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-bullseye"></i> Set Targets
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Staff Performance Leaderboard</h3>
      <div class="overflow-x-auto">
        <table class="data-table">
          <thead>
            <tr>
              <th class="text-left">Staff Member</th>
              <th class="text-left">New Members</th>
              <th class="text-left">Loan Recovery</th>
              <th class="text-left">Savings Growth</th>
              <th class="text-left">Score</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="i in 5">
              <tr class="table-row">
                <td>
                  <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-xs">SM</div>
                    <span class="text-xs font-semibold">Staff Name</span>
                  </div>
                </td>
                <td class="text-xs">24 / 30</td>
                <td class="text-xs">92%</td>
                <td class="text-xs">TZS 15.2M</td>
                <td>
                  <div class="w-full bg-gray-200 dark:bg-primary-900 rounded-full h-1.5 max-w-[100px]">
                    <div class="bg-primary-500 h-1.5 rounded-full" style="width: 85%"></div>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="space-y-4">
      <div class="card rounded-2xl p-5 bg-gradient-to-br from-primary-600 to-primary-800 text-white">
        <h3 class="font-bold text-xs uppercase tracking-wider opacity-80">Department Average</h3>
        <p class="text-3xl font-bold mt-2">88.4%</p>
        <p class="text-[10px] mt-1 opacity-70">+4.2% from last month</p>
      </div>
      
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-4" :class="darkMode?'text-primary-300':'text-primary-700'">Recent Performance Alerts</h3>
        <div class="space-y-3">
          <div class="p-3 rounded-xl bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20">
            <p class="text-[11px] font-bold text-red-600">Low Loan Recovery</p>
            <p class="text-[10px] text-gray-500 mt-0.5">Teller A is below 70% recovery target for May.</p>
          </div>
          <div class="p-3 rounded-xl bg-green-50 dark:bg-green-900/10 border border-green-100 dark:border-green-900/20">
            <p class="text-[11px] font-bold text-green-600">Target Reached!</p>
            <p class="text-[10px] text-gray-500 mt-0.5">Manager B has achieved 100% savings target.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
