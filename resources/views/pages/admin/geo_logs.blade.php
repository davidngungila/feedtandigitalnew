@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Geolocation Logs</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-map-location-dot mr-2"></i> View Map
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Access by Location</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">User</th>
            <th class="text-left">IP Address</th>
            <th class="text-left">Country / City</th>
            <th class="text-left">ISP</th>
            <th class="text-left">Last Activity</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="log in auditLogs.slice(0, 15)" :key="log.id">
            <tr class="table-row">
              <td class="text-xs font-semibold" x-text="log.user_name"></td>
              <td class="text-xs font-mono" x-text="log.ip_address"></td>
              <td>
                <div class="flex items-center gap-2">
                  <span class="text-[10px]">🇹🇿 Tanzania, Dar es Salaam</span>
                </div>
              </td>
              <td class="text-[11px] text-gray-500">TTCL / Vodacom</td>
              <td class="text-[11px]" x-text="log.time"></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
