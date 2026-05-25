@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Defaulter Analysis</h2>
    <div class="flex gap-2">
      <span class="badge badge-red font-bold">Total Overdue: TZS 42.5M</span>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="card rounded-2xl p-5 border-t-4 border-yellow-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">1 - 30 Days</p>
      <p class="text-xl font-bold">TZS 15.2M</p>
      <p class="text-[9px] text-gray-500 mt-1">24 Members</p>
    </div>
    <div class="card rounded-2xl p-5 border-t-4 border-orange-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">31 - 60 Days</p>
      <p class="text-xl font-bold">TZS 12.8M</p>
      <p class="text-[9px] text-gray-500 mt-1">15 Members</p>
    </div>
    <div class="card rounded-2xl p-5 border-t-4 border-red-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">61 - 90 Days</p>
      <p class="text-xl font-bold">TZS 8.5M</p>
      <p class="text-[9px] text-gray-500 mt-1">8 Members</p>
    </div>
    <div class="card rounded-2xl p-5 border-t-4 border-red-900">
      <p class="text-[10px] font-bold text-gray-400 uppercase">90+ Days</p>
      <p class="text-xl font-bold text-red-600">TZS 6.0M</p>
      <p class="text-[9px] text-gray-500 mt-1">4 Members</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Defaulters List</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Loan ID</th>
            <th class="text-right">Overdue Amount</th>
            <th class="text-right">Total Balance</th>
            <th class="text-left">Days Past Due</th>
            <th class="text-left">Last Contact</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-[10px] font-bold">AK</div>
                <span class="text-xs font-semibold">Amos Kibet</span>
              </div>
            </td>
            <td class="text-xs font-mono">LN-2026-442</td>
            <td class="text-right text-xs font-bold text-red-500">850,000</td>
            <td class="text-right text-xs">2,450,000</td>
            <td><span class="badge badge-red">42 Days</span></td>
            <td class="text-xs">20 May 2026</td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">Contact</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
