@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     ADMINISTRATION – USERS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">System Users</h2>
    <button @click="showModal('addUser')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus"></i> Add User
    </button>
  </div>
  <div class="card rounded-2xl p-5">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">User</th><th class="text-left">Role</th>
          <th class="text-left">Last Login</th><th class="text-left">Status</th><th class="text-left">Actions</th>
        </tr></thead>
        <tbody>
          <template x-for="u in systemUsers" :key="u.id">
            <tr class="table-row">
              <td>
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-800 flex items-center justify-center text-white text-xs font-bold" x-text="u.name.charAt(0)"></div>
                  <div>
                    <p class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="u.name"></p>
                    <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="u.email"></p>
                  </div>
                </div>
              </td>
              <td><span class="role-tag" :class="'role-'+u.role" x-text="u.roleLabel"></span></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="u.lastLogin"></td>
              <td><span class="badge" :class="u.active?'badge-green':'badge-red'" x-text="u.active?'Active':'Inactive'"></span></td>
              <td>
                <div class="flex gap-1">
                  <button class="p-1.5 rounded-lg text-blue-500 text-[11px] hover:bg-blue-900/20 transition-colors"><i class="fa-solid fa-pen"></i></button>
                  <button class="p-1.5 rounded-lg text-red-500 text-[11px] hover:bg-red-900/20 transition-colors"><i class="fa-solid fa-trash"></i></button>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
