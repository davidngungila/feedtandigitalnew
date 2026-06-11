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
          <th class="text-left">IP Address</th><th class="text-left">Status</th><th class="text-left">Actions</th>
        </tr></thead>
        <tbody>
          <template x-for="log in auditLogs" :key="log.id">
            <tr class="table-row">
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="log.time"></td>
              <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="log.user_name"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="log.action"></td>
              <td><span class="badge badge-blue text-[10px]" x-text="log.module"></span></td>
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="log.ip_address"></td>
              <td><span class="badge" :class="log.success?'badge-green':'badge-red'" x-text="log.success?'Success':'Failed'"></span></td>
              <td>
                <button @click="openAuditLogDetails(log)" class="text-primary-600 hover:text-primary-700 text-xs font-semibold">
                  View Details
                </button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Audit Log Details Modal -->
<div x-show="showAuditLogModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition>
  <div class="card rounded-2xl p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto" @click.outside="showAuditLogModal = false">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-lg" :class="darkMode?'text-white':'text-primary-900'">Audit Log Details</h3>
      <button @click="showAuditLogModal = false" class="p-2 rounded-lg hover:bg-gray-100" :class="darkMode?'hover:bg-primary-900/30':''">
        <i class="fa-solid fa-xmark" :class="darkMode?'text-white':''"></i>
      </button>
    </div>
    <template x-if="selectedAuditLog">
      <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">User</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedAuditLog.user_name"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Timestamp</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedAuditLog.time"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Action</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedAuditLog.action"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Module</p>
            <span class="badge badge-blue text-xs" x-text="selectedAuditLog.module"></span>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">IP Address</p>
            <p class="text-sm font-mono" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedAuditLog.ip_address"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Status</p>
            <span class="badge" :class="selectedAuditLog.success?'badge-green':'badge-red'" x-text="selectedAuditLog.success?'Success':'Failed'"></span>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Browser</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedAuditLog.browser"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Operating System</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedAuditLog.os"></p>
          </div>
        </div>
        <div>
          <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">User Agent</p>
          <p class="text-xs font-mono break-all" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="selectedAuditLog.user_agent"></p>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
