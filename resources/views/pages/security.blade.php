@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     SECURITY & COMPLIANCE PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Security & Compliance</h2>
  </div>

  <!-- Login Logs & Device Tracking -->
  <div x-show="activePage==='admin-audit'" class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4">Login Logs & Device Tracking</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">User</th>
            <th class="text-left">Device / Browser</th>
            <th class="text-left">IP Address</th>
            <th class="text-left">Location</th>
            <th class="text-left">Time</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="i in 5">
            <tr class="table-row">
              <td class="text-xs font-bold">Admin User</td>
              <td class="text-[10px]"><i class="fa-brands fa-chrome mr-1"></i> Chrome on Windows 11</td>
              <td class="text-[10px] font-mono">197.250.12.44</td>
              <td class="text-[10px]">Dar es Salaam, TZ</td>
              <td class="text-[10px]">16 May, 10:15 AM</td>
              <td><span class="badge badge-green">Authorized</span></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>

  <!-- 2FA Setup -->
  <div x-show="activePage==='admin-2fa'" class="card rounded-2xl p-6 max-w-xl">
    <h3 class="font-bold text-sm mb-4">Two-Factor Authentication (2FA)</h3>
    <div class="p-4 rounded-xl border-2 border-dashed border-primary-500 bg-primary-50 dark:bg-primary-900/10 mb-6">
      <div class="flex gap-4">
        <div class="w-12 h-12 rounded-xl bg-primary-600 text-white flex items-center justify-center text-xl shadow-lg"><i class="fa-solid fa-shield-halved"></i></div>
        <div>
          <p class="text-sm font-bold">2FA is currently DISABLED</p>
          <p class="text-xs text-gray-500">Enable 2FA to add an extra layer of security to your administrative account.</p>
        </div>
      </div>
    </div>
    <div class="space-y-4">
      <button class="w-full py-3 rounded-xl bg-primary-600 text-white font-bold text-sm">Enable Google Authenticator</button>
      <button class="w-full py-3 rounded-xl border-2 border-primary-500 text-primary-600 font-bold text-xs">Enable SMS Verification</button>
    </div>
  </div>
</div>
@endsection
