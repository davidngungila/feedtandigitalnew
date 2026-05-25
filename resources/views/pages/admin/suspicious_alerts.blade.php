@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Suspicious Activity Alerts</h2>
    <div class="flex gap-2">
      <span class="badge badge-red" x-text="amlAlerts.length + ' Active Alerts'"></span>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Activity Type</th>
            <th class="text-left">Risk Level</th>
            <th class="text-left">Status</th>
            <th class="text-left">Detected At</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="a in amlAlerts" :key="a.id">
            <tr class="table-row">
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-[10px] font-bold" x-text="a.member ? a.member.user.name.charAt(0) : '?'"></div>
                  <span class="text-xs font-semibold" x-text="a.member ? a.member.user.name : 'Unknown'"></span>
                </div>
              </td>
              <td class="text-xs" x-text="a.alert_type"></td>
              <td>
                <span class="badge" :class="a.risk_score > 70 ? 'badge-red' : (a.risk_score > 30 ? 'badge-yellow' : 'badge-blue')" x-text="a.risk_score > 70 ? 'Critical' : (a.risk_score > 30 ? 'Medium' : 'Low')"></span>
              </td>
              <td><span class="badge badge-gray text-[10px]" x-text="a.status"></span></td>
              <td class="text-[11px]" x-text="new Date(a.created_at).toLocaleString()"></td>
              <td>
                <button @click="navigate('admin-aml')" class="text-primary-600 text-xs font-bold hover:underline">Investigate</button>
              </td>
            </tr>
          </template>
          <template x-if="amlAlerts.length === 0">
            <tr><td colspan="6" class="text-center py-8 text-xs text-gray-500 italic">No suspicious activity alerts found</td></tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
