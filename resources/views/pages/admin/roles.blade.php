@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">User Roles & Permissions</h2>
    <button @click="showRoleModal = true; editingRole = null; resetRoleForm()" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus"></i> Create Role
    </button>
  </div>

  <div class="card rounded-2xl p-5 overflow-x-auto">
    <table class="data-table w-full">
      <thead>
        <tr>
          <th class="text-left">Role</th>
          <th class="text-left">Description</th>
          <th class="text-left">Permissions</th>
          <th class="text-left">Active Users</th>
          <th class="text-left">Status</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <template x-for="role in roles" :key="role.id">
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <span class="role-tag text-[10px]" :class="'role-'+(role.slug.includes('admin')?'admin':role.slug)" x-text="role.name"></span>
                <template x-if="role.is_system">
                  <span class="text-xs px-1.5 py-0.5 rounded bg-gray-200 text-gray-500" :class="darkMode?'bg-primary-900 text-primary-400':''">System</span>
                </template>
              </div>
            </td>
            <td class="text-xs text-gray-500" :class="darkMode?'text-primary-400':''" x-text="role.description || 'No description'"></td>
            <td class="text-xs text-gray-500" :class="darkMode?'text-primary-400':''">
              <i class="fa-solid fa-key mr-1"></i>
              <span x-text="role.permissions.length"></span>
            </td>
            <td>
              <template x-if="role.users && role.users.length > 0">
                <div class="flex flex-wrap gap-1 max-w-xs">
                  <template x-for="user in role.users.slice(0, 3)" :key="user.id">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-primary-100 text-primary-700 text-[9px] font-bold" :class="darkMode?'bg-primary-900 text-primary-300':''" x-text="user.name.charAt(0).toUpperCase()"></span>
                  </template>
                  <template x-if="role.users.length > 3">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-200 text-gray-600 text-[9px] font-bold" :class="darkMode?'bg-primary-800 text-primary-400':''" x-text="'+'+(role.users.length - 3)"></span>
                  </template>
                </div>
              </template>
              <template x-if="!role.users || role.users.length === 0">
                <span class="text-xs text-gray-400" :class="darkMode?'text-primary-500':''">No users</span>
              </template>
            </td>
            <td>
              <span class="badge text-[10px]" :class="role.is_active?'badge-green':'badge-red'" x-text="role.is_active?'Active':'Inactive'"></span>
            </td>
            <td class="text-center">
              <div class="flex items-center justify-center gap-1">
                <a :href="'/admin/roles/'+role.id" class="p-1.5 rounded-lg text-green-600 hover:bg-green-100 dark:hover:bg-green-900/20 transition-colors">
                  <i class="fa-solid fa-eye text-[10px]"></i>
                </a>
                <a :href="'/admin/roles/'+role.id+'/edit'" class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900/20 transition-colors">
                  <i class="fa-solid fa-pen text-[10px]"></i>
                </a>
                <template x-if="!role.is_system">
                  <button @click="deleteRole(role)" class="p-1.5 rounded-lg text-red-500 hover:bg-red-100 dark:hover:bg-red-900/20 transition-colors">
                    <i class="fa-solid fa-trash text-[10px]"></i>
                  </button>
                </template>
              </div>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</div>

<!-- Create/Edit Role Modal -->
<div x-show="showRoleModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition>
  <div class="card rounded-2xl p-6 w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto" @click.outside="showRoleModal = false">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-lg" :class="darkMode?'text-white':'text-primary-900'">
        <span x-text="editingRole?'Edit Role':'Create Role'"></span>
      </h3>
      <button @click="showRoleModal = false" class="p-2 rounded-lg hover:bg-gray-100" :class="darkMode?'hover:bg-primary-900/30':''">
        <i class="fa-solid fa-times" :class="darkMode?'text-white':''"></i>
      </button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="form-label">Name</label>
        <input type="text" x-model="roleForm.name" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
      </div>
      <div>
        <label class="form-label">Slug</label>
        <input type="text" x-model="roleForm.slug" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
      </div>
      <div class="md:col-span-2">
        <label class="form-label">Description</label>
        <textarea x-model="roleForm.description" rows="2" class="form-input input-field resize-none" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
      </div>
      <div>
        <label class="flex items-center gap-2">
          <input type="checkbox" x-model="roleForm.is_active" class="form-checkbox">
          <span :class="darkMode?'text-white':'text-primary-900'">Active</span>
        </label>
      </div>
    </div>

    <div class="mb-4">
      <h4 class="font-bold text-sm mb-2" :class="darkMode?'text-primary-200':'text-primary-900'">Permissions</h4>
      <div class="space-y-3 max-h-64 overflow-y-auto pr-2">
        <template x-for="(permissions, group) in groupedPermissions">
          <div class="border rounded-xl p-3" :class="darkMode?'border-primary-900/30 bg-primary-900/20':'border-gray-100 bg-gray-50'">
            <h5 class="text-xs font-bold uppercase tracking-wider mb-2" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="group || 'General'"></h5>
            <div class="grid grid-cols-2 gap-2">
              <template x-for="perm in permissions">
                <label class="flex items-center gap-2 p-2 rounded-lg cursor-pointer hover:bg-white/30 transition-colors" :class="darkMode?'hover:bg-primary-900/30':''">
                  <input type="checkbox" :value="perm.id" x-model="roleForm.permissions" class="form-checkbox">
                  <div class="flex flex-col">
                    <span class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="perm.name"></span>
                    <span class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="perm.description"></span>
                  </div>
                </label>
              </template>
            </div>
          </div>
        </template>
      </div>
    </div>
    <div class="flex gap-3 justify-end">
      <button @click="showRoleModal = false" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold transition-all" :class="darkMode?'bg-primary-900/30 hover:bg-primary-900/50 text-primary-200':''">
        Cancel
      </button>
      <button @click="saveRole" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-all">
        <i class="fa-solid fa-check mr-1.5"></i> <span x-text="editingRole?'Save Changes':'Create Role'"></span>
      </button>
    </div>
  </div>
</div>
@endsection
