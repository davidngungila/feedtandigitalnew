@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">AML & Fraud Detection</h2>
    <div class="flex gap-2">
      <span class="badge badge-red animate-pulse">4 Urgent Alerts</span>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Suspicious Transaction Monitoring</h3>
      <div class="overflow-x-auto">
        <table class="data-table">
          <thead>
            <tr>
              <th class="text-left">Member</th>
              <th class="text-left">Amount</th>
              <th class="text-left">Flag Type</th>
              <th class="text-left">Date</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="a in amlAlerts" :key="a.id">
              <tr class="table-row">
                <td class="text-xs font-semibold" x-text="a.member ? a.member.user.name : 'Unknown'"></td>
                <td class="text-xs font-bold text-red-600" x-text="a.transaction ? 'TZS ' + a.transaction.amount.toLocaleString() : 'N/A'"></td>
                <td><span class="badge badge-yellow" x-text="a.alert_type"></span></td>
                <td class="text-[10px]" x-text="new Date(a.created_at).toLocaleString()"></td>
                <td>
                  <div class="flex gap-2">
                    <select @change="updateAmlStatus(a.id, $event.target.value)" class="text-[10px] bg-transparent border-none font-bold text-primary-600 cursor-pointer">
                      <option :selected="a.status === 'New'" value="New">New</option>
                      <option :selected="a.status === 'Investigating'" value="Investigating">Investigate</option>
                      <option :selected="a.status === 'Resolved'" value="Resolved">Resolve</option>
                      <option :selected="a.status === 'False Positive'" value="False Positive">Dismiss</option>
                    </select>
                  </div>
                </td>
              </tr>
            </template>
            <template x-if="amlAlerts.length === 0">
              <tr>
                <td colspan="5" class="text-center py-8 text-xs text-gray-500 italic">No AML alerts found</td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Detection Rules</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-xs font-bold">Large Transaction Alert</p>
            <p class="text-[9px] text-gray-500">Flag deposits > TZS 10,000,000</p>
          </div>
          <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
        </div>
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-xs font-bold">Rapid Withdrawal Rule</p>
            <p class="text-[9px] text-gray-500">Withdrawal within 24h of large deposit</p>
          </div>
          <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
