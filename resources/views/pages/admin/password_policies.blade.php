@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Password Policies</h2>
    <button @click="saveSecurity()" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Save Changes
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Complexity Requirements</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Minimum Password Length</p>
            <p class="text-[10px] text-gray-500">Number of characters required</p>
          </div>
          <input type="number" x-model="securityForm.min_password_length" class="w-16 form-input input-field text-center" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Require Uppercase</p>
            <p class="text-[10px] text-gray-500">At least one uppercase letter</p>
          </div>
          <button @click="securityForm.require_uppercase = !securityForm.require_uppercase" 
                  class="relative w-10 h-5 rounded-full transition-colors"
                  :class="securityForm.require_uppercase ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-1 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="securityForm.require_uppercase ? 'right-1' : 'left-1'"></span>
          </button>
        </div>
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Require Numbers</p>
            <p class="text-[10px] text-gray-500">At least one numeric digit</p>
          </div>
          <button @click="securityForm.require_numbers = !securityForm.require_numbers" 
                  class="relative w-10 h-5 rounded-full transition-colors"
                  :class="securityForm.require_numbers ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-1 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="securityForm.require_numbers ? 'right-1' : 'left-1'"></span>
          </button>
        </div>
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Require Special Characters</p>
            <p class="text-[10px] text-gray-500">At least one symbol (@, #, $, etc.)</p>
          </div>
          <button @click="securityForm.require_symbols = !securityForm.require_symbols" 
                  class="relative w-10 h-5 rounded-full transition-colors"
                  :class="securityForm.require_symbols ? 'bg-primary-500' : 'bg-gray-300'">
            <span class="absolute top-1 w-3 h-3 bg-white rounded-full transition-transform"
                  :class="securityForm.require_symbols ? 'right-1' : 'left-1'"></span>
          </button>
        </div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Expiration & History</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Password Expiry (days)</p>
            <p class="text-[10px] text-gray-500">0 to disable expiry</p>
          </div>
          <input type="number" x-model="securityForm.password_expiry_days" class="w-16 form-input input-field text-center" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Password History</p>
            <p class="text-[10px] text-gray-500">Prevent reuse of last N passwords</p>
          </div>
          <input type="number" x-model="securityForm.password_history_count" class="w-16 form-input input-field text-center" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold">Max Login Attempts</p>
            <p class="text-[10px] text-gray-500">Lock account after N failed attempts</p>
          </div>
          <input type="number" x-model="securityForm.max_login_attempts" class="w-16 form-input input-field text-center" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
