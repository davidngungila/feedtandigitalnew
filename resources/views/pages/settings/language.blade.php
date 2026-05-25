@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Language Settings</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Save Changes
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="max-w-md space-y-6">
      <div>
        <label class="form-label">System Default Language</label>
        <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="en">English (United Kingdom)</option>
          <option value="sw" selected>Swahili (Tanzania)</option>
          <option value="fr">French</option>
        </select>
      </div>

      <div class="p-4 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
        <h3 class="text-xs font-bold mb-3 uppercase text-primary-600">Multi-Language Support</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <span class="text-xs">Allow members to switch language</span>
            <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-xs">Auto-translate notifications (AI)</span>
            <button class="relative w-8 h-4 bg-gray-300 rounded-full"><span class="absolute left-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
