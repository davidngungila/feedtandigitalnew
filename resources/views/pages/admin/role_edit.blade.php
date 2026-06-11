@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4" x-data="roleEditPage">
  <div class="flex items-center gap-3">
    <a href="/admin/roles" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-primary-900/30 transition-colors">
      <i class="fa-solid fa-arrow-left text-gray-600 dark:text-primary-300"></i>
    </a>
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Edit Role</h2>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
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

    <div class="mb-6">
      <h3 class="font-bold text-sm mb-3" :class="darkMode?'text-primary-200':'text-primary-800'">Permissions</h3>
      <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
        <template x-for="(permissions, group) in groupedPermissions">
          <div class="border rounded-xl p-4" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50'">
            <h4 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="group || 'General'"></h4>
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

    <div class="flex items-center justify-end gap-3">
      <a href="/admin/roles" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold transition-all" :class="darkMode?'bg-primary-900/30 hover:bg-primary-900/50 text-primary-200':''">
        Cancel
      </a>
      <button @click="saveRole" :disabled="isSaving" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 disabled:bg-gray-400 text-white text-sm font-semibold transition-all">
        <i class="fa-solid fa-check mr-1.5" x-show="!isSaving"></i>
        <i class="fa-solid fa-spinner fa-spin mr-1.5" x-show="isSaving"></i>
        Save Changes
      </button>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('roleEditPage', () => ({
    roleId: {{ $roleId }},
    role: null,
    isSaving: false,
    permissions: [],
    groupedPermissions: {},
    roleForm: {
      name: '',
      slug: '',
      description: '',
      is_active: true,
      permissions: []
    },
    
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
          this.roleForm.name = this.role.name;
          this.roleForm.slug = this.role.slug;
          this.roleForm.description = this.role.description;
          this.roleForm.is_active = this.role.is_active;
          this.roleForm.permissions = this.role.permissions.map(p => p.id);
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
    },
    
    async saveRole() {
      this.isSaving = true;
      try {
        const response = await fetch(`/roles/${this.roleId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.roleForm)
        });
        
        const result = await response.json();
        if (result.success) {
          window.location.href = '/admin/roles';
        } else {
          alert(result.message || 'Error saving role');
        }
      } catch (e) {
        console.error('Error saving role:', e);
        alert('Error saving role');
      } finally {
        this.isSaving = false;
      }
    }
  }));
});
</script>
@endpush
@endsection
