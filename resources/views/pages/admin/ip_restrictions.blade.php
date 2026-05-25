@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">IP Restrictions & Security</h2>
    <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus"></i> Add Whitelist IP
    </button>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Whitelisted IP Addresses</h3>
      <div class="overflow-x-auto">
        <table class="data-table">
          <thead>
            <tr>
              <th class="text-left">Label</th>
              <th class="text-left">IP Address</th>
              <th class="text-left">Added By</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="r in ipRestrictions" :key="r.id">
              <tr class="table-row">
                <td class="text-xs font-semibold" x-text="r.label"></td>
                <td class="text-xs font-mono" x-text="r.ip_address"></td>
                <td class="text-xs text-gray-500" x-text="r.added_by ? r.added_by.name : 'System'"></td>
                <td><button @click="deleteIpRestriction(r.id)" class="text-red-500 hover:bg-red-50 p-1.5 rounded-lg transition-colors"><i class="fa-solid fa-trash"></i></button></td>
              </tr>
            </template>
            <template x-if="ipRestrictions.length === 0">
              <tr>
                <td colspan="4" class="text-center py-8 text-xs text-gray-500 italic">No IP restrictions found</td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Add New Restriction</h3>
      <div class="space-y-4">
        <div>
          <label class="form-label">Label</label>
          <input type="text" x-model="ipForm.label" placeholder="e.g. HQ Office" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">IP Address</label>
          <input type="text" x-model="ipForm.ip_address" placeholder="197.250.12.44" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <button @click="saveIpRestriction()" class="w-full py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold text-xs transition-all shadow-lg shadow-primary-600/20">
          Add Whitelist IP
        </button>
      </div>

      <h3 class="font-bold text-sm mt-8 mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Access Policies</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Restrict Admin Login by IP</p>
            <p class="text-[10px] text-gray-500">Only allow whitelisted IPs to access admin panel</p>
          </div>
          <button @click="securityForm.restrict_ip = !securityForm.restrict_ip; saveSecurity()" 
                  class="relative w-10 h-5 rounded-full transition-colors"
                  :class="securityForm.restrict_ip ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-1 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="securityForm.restrict_ip ? 'right-1' : 'left-1'"></span>
          </button>
        </div>
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Geofencing Access</p>
            <p class="text-[10px] text-gray-500">Restrict access to specific regions (Tanzania only)</p>
          </div>
          <button @click="securityForm.geofencing = !securityForm.geofencing; saveSecurity()" 
                  class="relative w-10 h-5 rounded-full transition-colors"
                  :class="securityForm.geofencing ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-1 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="securityForm.geofencing ? 'right-1' : 'left-1'"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
