@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MY PROFILE PAGE
     ============================================================ -->
<div x-data="{ profileTab: 'personal' }" class="animate-[fadeIn_0.4s_ease] space-y-6">
  
  <!-- Profile Header Card -->
  <div class="card rounded-2xl overflow-hidden">
    <div class="h-32 bg-gradient-to-r from-primary-900 via-primary-800 to-primary-700 relative">
      <!-- Decorative elements -->
      <div class="absolute top-0 right-0 p-4 opacity-10">
        <i class="fa-solid fa-leaf text-8xl text-white"></i>
      </div>
    </div>
    <div class="px-6 pb-6 relative">
      <div class="flex flex-col md:flex-row md:items-end gap-6 -mt-12">
        <!-- Avatar -->
        <div class="relative group">
          <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 border-4 shadow-xl flex items-center justify-center text-white text-4xl font-bold flex-shrink-0"
               :class="darkMode ? 'border-[#0d1f16]' : 'border-white'">
            <template x-if="currentUser.profile_image">
              <img :src="currentUser.profile_image" class="w-full h-full object-cover rounded-xl">
            </template>
            <template x-if="!currentUser.profile_image">
              <span x-text="currentUser.name ? currentUser.name.charAt(0) : ''"></span>
            </template>
          </div>
          <button class="absolute bottom-2 right-2 w-8 h-8 rounded-lg bg-primary-600 text-white shadow-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
            <i class="fa-solid fa-camera text-xs"></i>
          </button>
        </div>

        <!-- User Info -->
        <div class="flex-1 space-y-1">
          <div class="flex items-center gap-3">
            <h2 class="text-2xl font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'" x-text="currentUser.name"></h2>
            <span class="role-tag" :class="'role-'+currentUser.role" x-text="currentUser.role ? currentUser.role.charAt(0).toUpperCase() + currentUser.role.slice(1) : ''"></span>
          </div>
          <p class="text-sm" :class="darkMode ? 'text-primary-400' : 'text-primary-600'" x-text="currentUser.email"></p>
        </div>

        <!-- Actions -->
        <div class="flex gap-2">
          <button @click="profileTab = 'personal'" class="px-4 py-2 rounded-xl text-xs font-semibold transition-all"
                  :class="profileTab === 'personal' ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : (darkMode ? 'bg-primary-900/30 text-primary-300' : 'bg-primary-50 text-primary-700')">
            <i class="fa-solid fa-user mr-1.5"></i> Edit Profile
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabs Navigation -->
  <div class="flex items-center gap-1 p-1 rounded-xl w-fit" :class="darkMode ? 'bg-primary-900/20' : 'bg-primary-50'">
    <button @click="profileTab = 'personal'" 
            class="px-4 py-2 rounded-lg text-xs font-semibold transition-all"
            :class="profileTab === 'personal' ? (darkMode ? 'bg-primary-800 text-white' : 'bg-white text-primary-900 shadow-sm') : 'text-primary-500 hover:text-primary-700'">
      Personal Info
    </button>
    <button @click="profileTab = 'security'" 
            class="px-4 py-2 rounded-lg text-xs font-semibold transition-all"
            :class="profileTab === 'security' ? (darkMode ? 'bg-primary-800 text-white' : 'bg-white text-primary-900 shadow-sm') : 'text-primary-500 hover:text-primary-700'">
      Security
    </button>
    <button @click="profileTab = 'activity'" 
            class="px-4 py-2 rounded-lg text-xs font-semibold transition-all"
            :class="profileTab === 'activity' ? (darkMode ? 'bg-primary-800 text-white' : 'bg-white text-primary-900 shadow-sm') : 'text-primary-500 hover:text-primary-700'">
      Activity Log
    </button>
    <template x-if="currentUser.role === 'member'">
      <button @click="profileTab = 'financial'" 
              class="px-4 py-2 rounded-lg text-xs font-semibold transition-all"
              :class="profileTab === 'financial' ? (darkMode ? 'bg-primary-800 text-white' : 'bg-white text-primary-900 shadow-sm') : 'text-primary-500 hover:text-primary-700'">
        Financial Summary
      </button>
    </template>
  </div>

  <!-- Tab Content: Personal Info -->
  <div x-show="profileTab === 'personal'" class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 space-y-6">
        <div class="card rounded-2xl p-6">
          <h3 class="font-bold text-sm mb-6" :class="darkMode ? 'text-primary-200' : 'text-primary-800'">Profile Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="form-label">Full Name</label>
              <input type="text" x-model="currentUser.name" class="form-input input-field" :class="darkMode ? 'bg-[#0a140e] border-[#1a3328]' : ''">
            </div>
            <div>
              <label class="form-label">Email Address</label>
              <input type="email" x-model="currentUser.email" class="form-input input-field" disabled :class="darkMode ? 'bg-[#0a140e] border-[#1a3328] opacity-50' : 'bg-gray-50 opacity-50'">
            </div>
            <div>
              <label class="form-label">Phone Number</label>
              <input type="text" value="+255 754 123 456" class="form-input input-field" :class="darkMode ? 'bg-[#0a140e] border-[#1a3328]' : ''">
            </div>
            <div>
              <label class="form-label">Gender</label>
              <select class="form-input input-field" :class="darkMode ? 'bg-[#0a140e] border-[#1a3328]' : ''">
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
            </div>
          </div>
          <div class="mt-4">
            <label class="form-label">Address</label>
            <textarea class="form-input input-field h-24" :class="darkMode ? 'bg-[#0a140e] border-[#1a3328]' : ''">Mbagala Kuu, Dar es Salaam, Tanzania</textarea>
          </div>
          <div class="mt-6 flex justify-end">
            <button @click="showToast('Profile updated successfully!', 'success')" class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-all">
              Save Changes
            </button>
          </div>
        </div>
      </div>
      
      <div class="space-y-6">
        <div class="card rounded-2xl p-6">
          <h3 class="font-bold text-sm mb-4" :class="darkMode ? 'text-primary-200' : 'text-primary-800'">Account Status</h3>
          <div class="space-y-4">
            <div class="flex items-center justify-between p-3 rounded-xl" :class="darkMode ? 'bg-primary-900/20' : 'bg-primary-50'">
              <span class="text-xs" :class="darkMode ? 'text-primary-400' : 'text-gray-600'">Role</span>
              <span class="text-xs font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'" x-text="currentUser.role"></span>
            </div>
            <div class="flex items-center justify-between p-3 rounded-xl" :class="darkMode ? 'bg-primary-900/20' : 'bg-primary-50'">
              <span class="text-xs" :class="darkMode ? 'text-primary-400' : 'text-gray-600'">Member Since</span>
              <span class="text-xs font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'">Jan 2024</span>
            </div>
            <div class="flex items-center justify-between p-3 rounded-xl" :class="darkMode ? 'bg-primary-900/20' : 'bg-primary-50'">
              <span class="text-xs" :class="darkMode ? 'text-primary-400' : 'text-gray-600'">Verification</span>
              <span class="badge badge-green">Verified</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Content: Security -->
  <div x-show="profileTab === 'security'" class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-6" :class="darkMode ? 'text-primary-200' : 'text-primary-800'">Change Password</h3>
        <div class="space-y-4">
          <div>
            <label class="form-label">Current Password</label>
            <input type="password" class="form-input input-field" placeholder="••••••••" :class="darkMode ? 'bg-[#0a140e] border-[#1a3328]' : ''">
          </div>
          <div>
            <label class="form-label">New Password</label>
            <input type="password" class="form-input input-field" placeholder="••••••••" :class="darkMode ? 'bg-[#0a140e] border-[#1a3328]' : ''">
          </div>
          <div>
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-input input-field" placeholder="••••••••" :class="darkMode ? 'bg-[#0a140e] border-[#1a3328]' : ''">
          </div>
          <div class="pt-2">
            <button @click="showToast('Password updated successfully!', 'success')" class="w-full py-3 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-semibold text-sm transition-all">
              Update Password
            </button>
          </div>
        </div>
      </div>

      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-6" :class="darkMode ? 'text-primary-200' : 'text-primary-800'">Security Settings</h3>
        <div class="space-y-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-primary-900'">Two-Factor Authentication</p>
              <p class="text-xs" :class="darkMode ? 'text-primary-400' : 'text-gray-500'">Secure your account with 2FA</p>
            </div>
            <button class="relative w-11 h-6 rounded-full bg-gray-300 transition-colors">
              <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white transition-transform"></span>
            </button>
          </div>
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-primary-900'">Login Alerts</p>
              <p class="text-xs" :class="darkMode ? 'text-primary-400' : 'text-gray-500'">Get notified of new logins</p>
            </div>
            <button class="relative w-11 h-6 rounded-full bg-primary-500 transition-colors">
              <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white translate-x-5 transition-transform"></span>
            </button>
          </div>
          <div class="pt-4 p-4 rounded-xl border-2 border-dashed" :class="darkMode ? 'border-[#1a3328]' : 'border-primary-100'">
            <div class="flex gap-3">
              <i class="fa-solid fa-circle-info text-primary-500 mt-0.5"></i>
              <div class="space-y-1">
                <p class="text-xs font-bold" :class="darkMode ? 'text-primary-200' : 'text-primary-800'">Active Sessions</p>
                <p class="text-[10px]" :class="darkMode ? 'text-primary-400' : 'text-gray-500'">You are currently logged in from this Chrome browser on Windows 11.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Content: Activity -->
  <div x-show="profileTab === 'activity'" class="space-y-6">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-6" :class="darkMode ? 'text-primary-200' : 'text-primary-800'">Recent Activity</h3>
      <div class="space-y-6 relative before:absolute before:inset-0 before:left-3 before:w-0.5 before:bg-primary-900/10 dark:before:bg-primary-100/10">
        <div class="relative pl-10">
          <div class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary-600 flex items-center justify-center text-white text-[10px] shadow-lg">
            <i class="fa-solid fa-key"></i>
          </div>
          <div>
            <p class="text-xs font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'">Logged in successfully</p>
            <p class="text-[10px]" :class="darkMode ? 'text-primary-400' : 'text-gray-500'">Today at 08:42 AM • IP: 192.168.1.45</p>
          </div>
        </div>
        <div class="relative pl-10">
          <div class="absolute left-0 top-0 w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-white text-[10px] shadow-lg">
            <i class="fa-solid fa-pen"></i>
          </div>
          <div>
            <p class="text-xs font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'">Updated profile information</p>
            <p class="text-[10px]" :class="darkMode ? 'text-primary-400' : 'text-gray-500'">Yesterday at 04:15 PM</p>
          </div>
        </div>
        <div class="relative pl-10">
          <div class="absolute left-0 top-0 w-6 h-6 rounded-full bg-green-600 flex items-center justify-center text-white text-[10px] shadow-lg">
            <i class="fa-solid fa-money-bill-transfer"></i>
          </div>
          <div>
            <p class="text-xs font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'">Deposited TZS 50,000 to RDA</p>
            <p class="text-[10px]" :class="darkMode ? 'text-primary-400' : 'text-gray-500'">14 May 2024 • Ref: DEP-99812</p>
          </div>
        </div>
      </div>
      <div class="mt-8 text-center">
        <button class="text-xs font-semibold text-primary-500 hover:text-primary-400">View Full Audit Trail</button>
      </div>
    </div>
  </div>

  <!-- Tab Content: Financial (Member Only) -->
  <div x-show="profileTab === 'financial' && currentUser.role === 'member'" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="card rounded-2xl p-5 border-l-4 border-green-500">
        <p class="text-xs font-semibold mb-1" :class="darkMode ? 'text-primary-400' : 'text-primary-500'">TOTAL SAVINGS</p>
        <p class="text-2xl font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'">TZS 2,840,000</p>
        <p class="text-[10px] mt-2 text-green-500"><i class="fa-solid fa-arrow-up mr-1"></i> 12% from last month</p>
      </div>
      <div class="card rounded-2xl p-5 border-l-4 border-blue-500">
        <p class="text-xs font-semibold mb-1" :class="darkMode ? 'text-primary-400' : 'text-primary-500'">LOAN BALANCE</p>
        <p class="text-2xl font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'">TZS 1,200,000</p>
        <p class="text-[10px] mt-2 text-blue-500">3 Installments remaining</p>
      </div>
      <div class="card rounded-2xl p-5 border-l-4 border-purple-500">
        <p class="text-xs font-semibold mb-1" :class="darkMode ? 'text-primary-400' : 'text-primary-500'">TOTAL SHARES</p>
        <p class="text-2xl font-bold" :class="darkMode ? 'text-white' : 'text-primary-900'">TZS 500,000</p>
        <p class="text-[10px] mt-2 text-purple-500">Qualified for dividends</p>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode ? 'text-primary-200' : 'text-primary-800'">Account Performance</h3>
      <div class="h-64 relative">
        <canvas id="profilePerformanceChart"></canvas>
      </div>
    </div>
  </div>

</div>
@endsection
