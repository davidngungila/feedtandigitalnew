@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     SETTINGS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">System Settings</h2>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- General Settings -->
    <div class="lg:col-span-2 space-y-4">
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">General Settings</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Organization Name</label>
            <input type="text" value="FeedTan Community Microfinance Group" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Registration No.</label>
            <input type="text" value="GMS/DSM/2018/001234" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Default Currency</label>
            <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
              <option selected>TZS – Tanzanian Shilling</option>
              <option>USD – US Dollar</option>
            </select>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Fiscal Year Start</label>
            <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
              <option>January</option><option>July</option>
            </select>
          </div>
        </div>
      </div>

      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Loan Configuration</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Default Interest Rate</label>
            <input type="number" value="18" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Processing Fee (%)</label>
            <input type="number" value="1" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Penalty Rate (%)</label>
            <input type="number" value="5" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
        </div>
      </div>

      <!-- Theme Settings -->
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Appearance</h3>
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
          <div>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'">Dark Mode</p>
            <p class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'">Enable dark/night mode</p>
          </div>
          <button @click="darkMode=!darkMode;saveDarkMode()"
                  class="relative w-11 h-6 rounded-full transition-colors duration-200"
                  :class="darkMode?'bg-primary-500':'bg-gray-300'">
            <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white transition-transform duration-200"
                  :class="darkMode?'translate-x-5':'translate-x-0'"></span>
          </button>
        </div>
      </div>
    </div>

    <!-- Quick Settings Sidebar -->
    <div class="space-y-4">
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-4" :class="darkMode?'text-primary-300':'text-primary-700'">Notifications</h3>
        <div class="space-y-3">
          <template x-for="setting in notifSettings" :key="setting.id">
            <div class="flex items-center justify-between">
              <span class="text-xs" :class="darkMode?'text-primary-300':'text-gray-700'" x-text="setting.label"></span>
              <button class="relative w-9 h-5 rounded-full transition-colors duration-200"
                      :class="setting.on?'bg-primary-500':'bg-gray-400'"
                      @click="setting.on=!setting.on">
                <span class="absolute top-0.5 left-0.5 w-4 h-4 rounded-full bg-white transition-transform duration-200"
                      :class="setting.on?'translate-x-4':'translate-x-0'"></span>
              </button>
            </div>
          </template>
        </div>
      </div>

      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-4" :class="darkMode?'text-primary-300':'text-primary-700'">Main Office</h3>
        <div class="space-y-2.5">
          <div class="flex items-center justify-between p-2 rounded-xl" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
            <div>
              <p class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'">Dar es Salaam HQ</p>
              <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'">Dar es Salaam, Tanzania</p>
            </div>
            <span class="badge badge-green text-[10px]">Active</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
