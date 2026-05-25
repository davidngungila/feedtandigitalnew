@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Device Tracking</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        <i class="fa-solid fa-sync mr-2"></i> Refresh Data
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Mobile Devices</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">42%</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Desktop Devices</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">55%</p>
    </div>
    <div class="card rounded-2xl p-5 text-center">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Other</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">3%</p>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Device Access Log</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">User</th>
            <th class="text-left">Device Details</th>
            <th class="text-left">IP Address</th>
            <th class="text-left">Last Seen</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="log in auditLogs.filter(l => l.action === 'Login')" :key="log.id">
            <tr class="table-row">
              <td class="text-xs font-semibold" x-text="log.user_name"></td>
              <td class="text-xs">
                <div class="flex items-center gap-2">
                  <i :class="log.os === 'Windows' ? 'fa-brands fa-windows' : (log.os === 'MacOS' ? 'fa-brands fa-apple' : (log.os === 'Android' ? 'fa-brands fa-android' : (log.os === 'iOS' ? 'fa-solid fa-mobile-screen' : 'fa-solid fa-desktop')))" class="text-primary-500"></i>
                  <span x-text="log.os + ' (' + log.browser + ')'"></span>
                </div>
              </td>
              <td class="text-xs font-mono" x-text="log.ip_address"></td>
              <td class="text-[11px]" x-text="log.time"></td>
              <td><span class="badge badge-green text-[10px]">Verified</span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
