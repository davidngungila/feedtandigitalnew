@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Device & Session Management</h2>
    <button @click="terminateAllSessions()" class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all">
      Terminate All Other Sessions
    </button>
  </div>

  <div class="card rounded-2xl p-5">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Active Administrative Sessions</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">User</th>
            <th class="text-left">Device / Browser</th>
            <th class="text-left">IP Address</th>
            <th class="text-left">Started At</th>
            <th class="text-left">Last Activity</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="s in activeSessions" :key="s.id">
            <tr class="table-row">
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center text-[10px] font-bold" x-text="s.name.charAt(0)"></div>
                  <div>
                    <p class="text-xs font-semibold" x-text="s.name"></p>
                    <p class="text-[10px] text-gray-500" x-text="s.email"></p>
                  </div>
                </div>
              </td>
              <td class="text-xs">
                <i class="fa-solid fa-display mr-1"></i>
                <span x-text="s.user_agent.substring(0, 40) + '...'"></span>
              </td>
              <td class="text-xs font-mono" x-text="s.ip_address"></td>
              <td class="text-xs" x-text="new Date(s.last_activity * 1000).toLocaleString()"></td>
              <td><span class="badge badge-green text-[10px]">Active</span></td>
              <td>
                <button @click="terminateSession(s.id)" class="text-red-500 text-xs hover:underline">Terminate</button>
              </td>
            </tr>
          </template>
          <template x-if="activeSessions.length === 0">
            <tr><td colspan="6" class="text-center py-8 text-xs text-gray-500 italic">No active sessions found</td></tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
