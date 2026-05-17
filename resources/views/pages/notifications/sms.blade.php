@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     NOTIFICATIONS / SMS LOGS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">SMS / Notification Logs</h2>
  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Recipient</th><th class="text-left">Phone</th>
          <th class="text-left">Message</th><th class="text-left">Type</th>
          <th class="text-left">Sent At</th><th class="text-left">Status</th>
        </tr></thead>
        <tbody>
          <template x-for="n in smsLogs" :key="n.id">
            <tr class="table-row">
              <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="n.member"></td>
              <td class=" text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="n.phone"></td>
              <td class="text-[11px] max-w-xs truncate" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="n.message"></td>
              <td><span class="badge text-[10px]" :class="n.type==='deposit'?'badge-green':n.type==='loan'?'badge-blue':'badge-yellow'" x-text="n.type"></span></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="n.sentAt"></td>
              <td><span class="badge badge-green text-[10px]">Delivered</span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
