@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     SECURITY & COMPLIANCE PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Security Settings</h2>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 space-y-4">
      <!-- Password Change -->
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Change Password</h3>
        <div class="space-y-4 max-w-md">
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Current Password</label>
            <input type="password" x-model="passwordForm.current_password" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">New Password</label>
            <input type="password" x-model="passwordForm.password" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Confirm New Password</label>
            <input type="password" x-model="passwordForm.password_confirmation" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <button @click="changePassword()" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
            Update Password
          </button>
        </div>
      </div>

      <!-- Security Policies -->
      <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Security Policies</h3>
          <button @click="saveSecurity()" class="px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-[10px] font-semibold">
            Save Policies
          </button>
        </div>
        <div class="space-y-4">
          <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-[#1a3328]':'border-primary-50'">
            <div>
              <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'">Enforce Strong Passwords</p>
              <p class="text-xs text-gray-500">Require min 8 chars, numbers and symbols</p>
            </div>
            <button @click="securityForm.strong_password = !securityForm.strong_password" 
                    class="relative w-11 h-6 rounded-full transition-colors"
                    :class="securityForm.strong_password ? 'bg-primary-500' : 'bg-gray-300'">
              <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white transition-transform"
                    :class="securityForm.strong_password ? 'translate-x-5' : 'translate-x-0'"></span>
            </button>
          </div>
          <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-[#1a3328]':'border-primary-50'">
            <div>
              <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'">Login Session Timeout (min)</p>
            </div>
            <input type="number" x-model="securityForm.session_timeout" class="w-20 form-input input-field text-center" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
        </div>
      </div>
    </div>

    <div class="space-y-4">
      <!-- 2FA Setup -->
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Two-Factor Authentication</h3>
        
        <div class="p-4 rounded-xl border-2 border-dashed mb-6 text-center"
             :class="currentUser.two_factor_enabled ? 'border-green-500 bg-green-50 dark:bg-green-900/10' : 'border-primary-500 bg-primary-50 dark:bg-primary-900/10'">
          <div class="flex flex-col items-center gap-2">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-lg"
                 :class="currentUser.two_factor_enabled ? 'bg-green-600 text-white' : 'bg-primary-600 text-white'">
              <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
              <p class="text-sm font-bold uppercase tracking-tight" :class="currentUser.two_factor_enabled ? 'text-green-600' : 'text-primary-600'">
                2FA is <span x-text="currentUser.two_factor_enabled ? 'ENABLED' : 'DISABLED'"></span>
              </p>
              <p class="text-[10px] mt-1" :class="darkMode?'text-primary-400':'text-gray-500'">
                <template x-if="currentUser.two_factor_enabled">
                  <span x-text="'Active via ' + (currentUser.two_factor_type === 'authenticator' ? 'Authenticator App' : (currentUser.two_factor_type === 'sms' ? 'SMS Verification' : 'Email Verification'))"></span>
                </template>
                <template x-if="!currentUser.two_factor_enabled">
                  <span>Enable 2FA to add an extra layer of security to your account.</span>
                </template>
              </p>
            </div>
          </div>
        </div>

        <div class="space-y-3">
          <button @click="toggle2FA('authenticator', currentUser.two_factor_enabled && currentUser.two_factor_type === 'authenticator')" 
                  class="w-full py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-2 transition-all"
                  :class="currentUser.two_factor_enabled && currentUser.two_factor_type === 'authenticator' ? 'bg-red-600 text-white hover:bg-red-700' : 'bg-primary-600 text-white hover:bg-primary-700'">
            <i class="fa-solid fa-mobile-screen"></i>
            <span x-text="currentUser.two_factor_enabled && currentUser.two_factor_type === 'authenticator' ? 'Disable Authenticator' : 'Enable Authenticator'"></span>
          </button>
          
          <button @click="toggle2FA('sms', currentUser.two_factor_enabled && currentUser.two_factor_type === 'sms')"
                  class="w-full py-3 rounded-xl border-2 font-bold text-xs flex items-center justify-center gap-2 transition-all"
                  :class="currentUser.two_factor_enabled && currentUser.two_factor_type === 'sms' ? 'border-red-500 text-red-600 hover:bg-red-50' : 'border-primary-500 text-primary-600 hover:bg-primary-50'">
            <i class="fa-solid fa-comment-sms"></i>
            <span x-text="currentUser.two_factor_enabled && currentUser.two_factor_type === 'sms' ? 'Disable SMS 2FA' : 'Enable SMS 2FA'"></span>
          </button>

          <button @click="toggle2FA('email', currentUser.two_factor_enabled && currentUser.two_factor_type === 'email')"
                  class="w-full py-3 rounded-xl border-2 font-bold text-xs flex items-center justify-center gap-2 transition-all"
                  :class="currentUser.two_factor_enabled && currentUser.two_factor_type === 'email' ? 'border-red-500 text-red-600 hover:bg-red-50' : 'border-blue-500 text-blue-600 hover:bg-blue-50'">
            <i class="fa-solid fa-envelope"></i>
            <span x-text="currentUser.two_factor_enabled && currentUser.two_factor_type === 'email' ? 'Disable Email 2FA' : 'Enable Email 2FA'"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
