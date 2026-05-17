@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     AUDIT LOGS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Audit Logs</h2>
  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Timestamp</th><th class="text-left">User</th>
          <th class="text-left">Action</th><th class="text-left">Module</th>
          <th class="text-left">IP Address</th><th class="text-left">Status</th>
        </tr></thead>
        <tbody>
          <template x-for="log in auditLogs" :key="log.id">
            <tr class="table-row">
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="log.time"></td>
              <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="log.user"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="log.action"></td>
              <td><span class="badge badge-blue text-[10px]" x-text="log.module"></span></td>
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="log.ip"></td>
              <td><span class="badge" :class="log.success?'badge-green':'badge-red'" x-text="log.success?'Success':'Failed'"></span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
