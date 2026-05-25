@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">User Roles & Permissions</h2>
    <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus"></i> Create Role
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <template x-for="role in ['Admin', 'Manager', 'Teller', 'Auditor', 'Member']">
      <div class="card rounded-2xl p-5 space-y-4">
        <div class="flex items-center justify-between">
          <span class="role-tag" :class="'role-'+role.toLowerCase()" x-text="role"></span>
          <div class="flex gap-1">
            <button class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-900/20 transition-colors"><i class="fa-solid fa-pen text-[10px]"></i></button>
            <button class="p-1.5 rounded-lg text-red-500 hover:bg-red-900/20 transition-colors"><i class="fa-solid fa-trash text-[10px]"></i></button>
          </div>
        </div>
        <p class="text-xs text-gray-500" :class="darkMode?'text-primary-400':''">Permissions: Dashboard, Members, Savings, Loans, Reports, Settings</p>
        <div class="pt-2 border-t" :class="darkMode?'border-primary-900/30':'border-gray-50'">
          <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Users with this role</p>
          <div class="flex -space-x-2 mt-2">
            <template x-for="i in 3">
              <div class="w-7 h-7 rounded-full border-2 border-white dark:border-[#0d1f16] bg-primary-600 flex items-center justify-center text-[10px] text-white font-bold">U</div>
            </template>
            <div class="w-7 h-7 rounded-full border-2 border-white dark:border-[#0d1f16] bg-gray-200 dark:bg-primary-900 flex items-center justify-center text-[10px] text-gray-500 font-bold">+5</div>
          </div>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
