@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4" x-data="roleDetailPage">
  <div class="flex items-center gap-3">
    <a href="/admin/roles" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-primary-900/30 transition-colors">
      <i class="fa-solid fa-arrow-left text-gray-600 dark:text-primary-300"></i>
    </a>
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">View Role</h2>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Role Details Card -->
    <div class="lg:col-span-2 space-y-4">
      <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-3">
            <span class="role-tag" :class="'role-'+(role.slug.includes('admin')?'admin':role.slug)" x-text="role.name"></span>
            <template x-if="role.is_system">
              <span class="badge badge-blue text-[10px]">System</span>
            </template>
            <span class="badge" :class="role.is_active?'badge-green':'badge-red'" x-text="role.is_active?'Active':'Inactive'"></span>
          </div>
          <a :href="'/admin/roles/'+role.id+'/edit'" class="px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
            <i class="fa-solid fa-edit mr-1"></i> Edit Role
          </a>
        </div>
        
        <p class="text-sm text-gray-600 dark:text-primary-300 mb-6" x-text="role.description || 'No description'"></p>
        
        <div class="space-y-6">
          <!-- Permissions Section -->
          <div>
            <h3 class="font-bold text-sm mb-3" :class="darkMode?'text-primary-200':'text-primary-800'">Permissions</h3>
            <div class="space-y-3" x-if="role.permissions">
              <template x-for="(permissions, group) in groupedPermissions">
                <div class="border rounded-xl p-4" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50'">
                  <h4 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="group || 'General'"></h4>
                  <div class="grid grid-cols-2 gap-2">
                    <template x-for="perm in role.permissions.filter(p => p.group_name === group)">
                      <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white dark:bg-primary-900/30 text-xs">
                        <i class="fa-solid fa-check-circle text-green-500"></i>
                        <span x-text="perm.name"></span>
                      </span>
                    </template>
                  </div>
                </div>
              </template>
            </div>
          </div>

          <!-- Users Section -->
          <div>
            <h3 class="font-bold text-sm mb-3" :class="darkMode?'text-primary-200':'text-primary-800'">
              Active Users
              <span class="text-xs font-normal text-gray-500 dark:text-primary-400" x-text="`(${role.users?.length || 0})`"></span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <template x-for="user in role.users" :key="user.id">
                <div class="flex items-center gap-3 p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
                  <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center text-primary-700 dark:text-primary-300 font-bold text-sm" x-text="user.name.charAt(0).toUpperCase()"></div>
                  <div class="flex-1">
                    <p class="text-sm font-medium" :class="darkMode?'text-white':'text-primary-900'" x-text="user.name"></p>
                    <p class="text-xs text-gray-500 dark:text-primary-400" x-text="user.email"></p>
                  </div>
                </div>
              </template>
              <template x-if="!role.users || role.users.length === 0">
                <div class="col-span-2 text-center py-8">
                  <i class="fa-solid fa-users text-3xl text-gray-300 dark:text-primary-700 mb-3"></i>
                  <p class="text-sm text-gray-500 dark:text-primary-400">No active users assigned to this role</p>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar Stats -->
    <div class="space-y-4">
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Quick Stats</h3>
        <div class="space-y-4">
          <div>
            <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-500 dark:text-primary-400">Permissions</p>
            <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="role.permissions?.length || 0"></p>
          </div>
          <div>
            <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-500 dark:text-primary-400">Active Users</p>
            <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="role.users?.length || 0"></p>
          </div>
          <div>
            <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-500 dark:text-primary-400">Created</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="new Date(role.created_at).toLocaleDateString()"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('roleDetailPage', () => ({
    roleId: {{ $roleId }},
    role: null,
    permissions: [],
    groupedPermissions: {},
    
    async init() {
      await this.loadRole();
      await this.loadAllPermissions();
    },
    
    async loadRole() {
      try {
        const response = await fetch(`/roles/${this.roleId}`);
        const result = await response.json();
        if (result.success) {
          this.role = result.role;
        }
      } catch (e) {
        console.error('Error loading role:', e);
      }
    },
    
    async loadAllPermissions() {
      try {
        const response = await fetch(`/permissions`);
        const result = await response.json();
        if (result.success) {
          this.permissions = result.permissions;
          this.groupedPermissions = result.grouped;
        }
      } catch (e) {
        console.error('Error loading permissions:', e);
      }
    }
  }));
});
</script>
@endpush
@endsection
