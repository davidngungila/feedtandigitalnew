@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Active User Sessions</h2>
    <div class="flex gap-2">
      <span class="badge badge-green" x-text="activeSessions.length + ' Online Now'"></span>
      <button @click="terminateAllSessions()" class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all">
        Terminate All Other Sessions
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">User</th>
            <th class="text-left">Device / Browser</th>
            <th class="text-left">IP Address</th>
            <th class="text-left">Last Activity</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="s in activeSessions" :key="s.id">
            <tr class="table-row">
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold" x-text="s.name ? s.name.charAt(0) : '?'"></div>
                  <div>
                    <p class="text-xs font-semibold" x-text="s.name || 'Guest'"></p>
                    <p class="text-[10px] text-gray-500" x-text="s.email || '-'"></p>
                  </div>
                </div>
              </td>
              <td class="text-xs">
                <i class="fa-solid fa-display mr-1"></i>
                <span x-text="s.user_agent ? s.user_agent.substring(0, 40) + '...' : 'Unknown'"></span>
              </td>
              <td class="text-xs font-mono" x-text="s.ip_address"></td>
              <td class="text-xs" x-text="new Date(s.last_activity * 1000).toLocaleString()"></td>
              <td>
                <button @click="terminateSession(s.id)" class="text-red-500 text-xs hover:underline">Terminate</button>
              </td>
            </tr>
          </template>
          <template x-if="activeSessions.length === 0">
            <tr><td colspan="5" class="text-center py-8 text-xs text-gray-500 italic">No active sessions found</td></tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
