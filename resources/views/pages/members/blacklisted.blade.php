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
            <th class="text-left">Status</th>
            <th class="text-left">Date Joined</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-if="blacklisted && blacklisted.length > 0">
            <template x-for="member in blacklisted" :key="member.id">
              <tr class="table-row">
                <td>
                  <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-[10px] font-bold" x-text="member.user ? member.user.name.charAt(0).toUpperCase() : '?'"></div>
                    <span class="text-xs font-semibold" x-text="member.user ? member.user.name : 'Unknown'"></span>
                  </div>
                </td>
                <td class="text-xs font-mono" x-text="member.member_no"></td>
                <td><span class="badge badge-red" x-text="member.status"></span></td>
                <td class="text-xs" x-text="member.joined_at ? new Date(member.joined_at).toLocaleDateString() : ''"></td>
                <td>
                  <button class="text-primary-600 hover:underline text-xs font-bold">View History</button>
                  <span class="mx-1">|</span>
                  <button class="text-green-500 hover:underline text-xs font-bold">Whitelist</button>
                </td>
              </tr>
            </template>
          </template>
          <template x-if="!blacklisted || blacklisted.length === 0">
            <tr>
              <td colspan="5" class="text-center py-12 text-gray-500 text-xs">No blacklisted members</td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
