@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     AUDIT REPORTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Audit & System Reports</h2>
  </div>

  <div class="card rounded-2xl p-6 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
    <h3 class="text-sm font-bold mb-4" :class="darkMode?'text-white':'text-primary-900'">System Activity Log</h3>
    <p class="text-xs mb-6" :class="darkMode?'text-primary-400':'text-gray-500'">Review all system-wide changes, user logins, and administrative actions.</p>
    
    <div class="space-y-4">
      <div class="flex items-center gap-4">
        <div class="flex-1">
          <label class="form-label">Date Range</label>
          <div class="grid grid-cols-2 gap-2">
            <input type="date" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
            <input type="date" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
          </div>
        </div>
        <div class="flex-1">
          <label class="form-label">User Role</label>
          <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
            <option>All Roles</option>
            <option>Admin</option>
            <option>Manager</option>
            <option>Teller</option>
          </select>
        </div>
        <div class="flex items-end">
          <button class="px-6 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">Filter Activity</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
