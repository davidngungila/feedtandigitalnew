@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Business Profile</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Update Profile
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-6 flex flex-col items-center">
      <div class="w-32 h-32 rounded-2xl bg-primary-100 flex items-center justify-center text-primary-600 text-5xl mb-4"><i class="fa-solid fa-leaf"></i></div>
      <button class="text-[10px] font-bold text-primary-600 hover:underline">Change Logo</button>
    </div>

    <div class="md:col-span-2 card rounded-2xl p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="form-label">Business Name</label>
          <input type="text" value="Feedtan Digital Microfinance" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">Registration Number</label>
          <input type="text" value="MF-2026-99281" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">TIN Number</label>
          <input type="text" value="123-456-789" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">Business Email</label>
          <input type="email" value="info@feedtan.co.tz" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div class="md:col-span-2">
          <label class="form-label">Physical Address</label>
          <textarea rows="3" class="form-input input-field resize-none" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">Plot 123, Victoria Area, New Bagamoyo Road, Dar es Salaam, Tanzania</textarea>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
