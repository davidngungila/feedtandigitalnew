@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">OTP & Security Settings</h2>
    <button @click="saveOtpSettings()" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Save OTP Config
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Verification Methods</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-mobile-screen text-primary-500"></i>
            <div>
              <p class="text-xs font-bold">SMS OTP</p>
              <p class="text-[10px] text-gray-500">Send verification codes via SMS</p>
            </div>
          </div>
          <button @click="otpSettings.sms = !otpSettings.sms" 
                  class="relative w-8 h-4 rounded-full transition-colors"
                  :class="otpSettings.sms ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-0.5 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="otpSettings.sms ? 'right-0.5' : 'left-0.5'"></span>
          </button>
        </div>
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-envelope text-primary-500"></i>
            <div>
              <p class="text-xs font-bold">Email OTP</p>
              <p class="text-[10px] text-gray-500">Send verification codes via Email</p>
            </div>
          </div>
          <button @click="otpSettings.email = !otpSettings.email" 
                  class="relative w-8 h-4 rounded-full transition-colors"
                  :class="otpSettings.email ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-0.5 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="otpSettings.email ? 'right-0.5' : 'left-0.5'"></span>
          </button>
        </div>
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-shield-halved text-primary-500"></i>
            <div>
              <p class="text-xs font-bold">2FA (Authenticator App)</p>
              <p class="text-[10px] text-gray-500">Google/Microsoft Authenticator</p>
            </div>
          </div>
          <button @click="otpSettings.app = !otpSettings.app" 
                  class="relative w-8 h-4 rounded-full transition-colors"
                  :class="otpSettings.app ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-0.5 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="otpSettings.app ? 'right-0.5' : 'left-0.5'"></span>
          </button>
        </div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">OTP Policies</h3>
      <div class="space-y-4">
        <div>
          <label class="form-label">OTP Expiry (Minutes)</label>
          <input type="number" x-model="otpSettings.expiry" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">Max Retries</label>
          <input type="number" x-model="otpSettings.retries" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">OTP Length</label>
          <select x-model="otpSettings.length" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option value="4">4 Digits</option>
            <option value="6">6 Digits</option>
            <option value="8">8 Digits</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
