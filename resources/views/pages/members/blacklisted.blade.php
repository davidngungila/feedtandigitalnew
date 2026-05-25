@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Blacklisted Members</h2>
    <button class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-user-slash mr-2"></i> Blacklist Member
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member Name</th>
            <th class="text-left">Member ID</th>
            <th class="text-left">Reason</th>
            <th class="text-left">Date Blacklisted</th>
            <th class="text-left">Blacklisted By</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-[10px] font-bold">SM</div>
                <span class="text-xs font-semibold">Said Musa</span>
              </div>
            </td>
            <td class="text-xs font-mono">MEM-8821</td>
            <td class="text-xs">Multiple defaults and fraud attempt</td>
            <td class="text-xs">15 Jan 2026</td>
            <td class="text-xs">Admin</td>
            <td>
              <button class="text-primary-600 hover:underline text-xs font-bold">View History</button>
              <span class="mx-1">|</span>
              <button class="text-red-500 hover:underline text-xs font-bold">Whitelist</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
