@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Failed Login Attempts</h2>
    <span class="badge badge-red" x-text="failedLogins.length + ' Attempts Logged'"></span>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Timestamp</th>
            <th class="text-left">IP Address</th>
            <th class="text-left">Device / Browser</th>
            <th class="text-left">Module</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="log in failedLogins" :key="log.id">
            <tr class="table-row">
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="log.time"></td>
              <td class="text-xs font-mono" :class="darkMode?'text-primary-300':'text-primary-700'" x-text="log.ip_address"></td>
              <td class="text-xs">
                <div class="flex items-center gap-2">
                   <i :class="log.browser === 'Chrome' ? 'fa-brands fa-chrome' : (log.browser === 'Firefox' ? 'fa-brands fa-firefox' : (log.browser === 'Safari' ? 'fa-brands fa-safari' : 'fa-brands fa-edge'))" class="text-gray-400"></i>
                   <span x-text="log.browser + ' on ' + log.os"></span>
                </div>
              </td>
              <td><span class="badge badge-gray text-[10px]" x-text="log.module"></span></td>
              <td><span class="badge badge-red text-[10px]">Failed</span></td>
            </tr>
          </template>
          <template x-if="failedLogins.length === 0">
            <tr>
              <td colspan="5" class="text-center py-8 text-xs text-gray-500 italic">No failed login attempts found</td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
