@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Fraud Detection Alerts</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all">
        Clear Non-Critical Alerts
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Critical Alerts</p>
      <p class="text-2xl font-bold text-red-600">3</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Suspicious Activity</p>
      <p class="text-2xl font-bold text-yellow-500">12</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Resolved Today</p>
      <p class="text-2xl font-bold text-green-500">8</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Risk Score (Avg)</p>
      <p class="text-2xl font-bold text-primary-500">14%</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Recent Fraud Alerts</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Type</th>
            <th class="text-left">Description</th>
            <th class="text-left">Risk Level</th>
            <th class="text-left">Detected At</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td><span class="badge badge-red">Login Brute Force</span></td>
            <td class="text-xs">Multiple failed attempts from IP 192.168.1.50</td>
            <td><span class="badge badge-red">High</span></td>
            <td class="text-[11px]">Today, 10:15 AM</td>
            <td><button class="text-primary-600 font-bold text-[10px]">Investigate</button></td>
          </tr>
          <tr class="table-row">
            <td><span class="badge badge-yellow">Unusual Login</span></td>
            <td class="text-xs">Login from new device in unexpected location</td>
            <td><span class="badge badge-yellow">Medium</span></td>
            <td class="text-[11px]">Today, 09:30 AM</td>
            <td><button class="text-primary-600 font-bold text-[10px]">Investigate</button></td>
          </tr>
          <tr class="table-row">
            <td><span class="badge badge-blue">Large Transaction</span></td>
            <td class="text-xs">Single deposit exceeding TZS 20,000,000</td>
            <td><span class="badge badge-blue">Info</span></td>
            <td class="text-[11px]">Yesterday, 04:20 PM</td>
            <td><button class="text-primary-600 font-bold text-[10px]">Review</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
