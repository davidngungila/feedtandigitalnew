@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Staff Performance</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-trophy mr-2"></i> View Rankings
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Staff Member</th>
            <th class="text-left">Role</th>
            <th class="text-left">Active Portfolio</th>
            <th class="text-left">Recovery Rate</th>
            <th class="text-left">New Members</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold">SM</div>
                <span class="text-xs font-semibold">Samuel Mwakatobe</span>
              </div>
            </td>
            <td class="text-xs">Loan Officer</td>
            <td class="text-xs font-bold">TZS 145.2M</td>
            <td>
              <div class="flex items-center gap-2">
                <span class="text-xs font-bold">98.2%</span>
                <div class="w-16 bg-gray-100 dark:bg-primary-900/30 rounded-full h-1.5">
                  <div class="bg-green-500 h-1.5 rounded-full" style="width: 98%"></div>
                </div>
              </div>
            </td>
            <td class="text-xs">24</td>
            <td><span class="badge badge-green">Top Performer</span></td>
          </tr>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold">AJ</div>
                <span class="text-xs font-semibold">Anna Juma</span>
              </div>
            </td>
            <td class="text-xs">Loan Officer</td>
            <td class="text-xs font-bold">TZS 88.5M</td>
            <td>
              <div class="flex items-center gap-2">
                <span class="text-xs font-bold">92.5%</span>
                <div class="w-16 bg-gray-100 dark:bg-primary-900/30 rounded-full h-1.5">
                  <div class="bg-blue-500 h-1.5 rounded-full" style="width: 92%"></div>
                </div>
              </div>
            </td>
            <td class="text-xs">15</td>
            <td><span class="badge badge-blue">On Track</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
