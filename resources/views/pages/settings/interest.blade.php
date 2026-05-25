@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Interest Calculation Methods</h2>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-6 border-t-4 border-primary-600">
      <h3 class="font-bold text-sm mb-2">Flat Rate</h3>
      <p class="text-[10px] text-gray-500 mb-4">Interest is calculated on the original principal throughout the loan term.</p>
      <div class="flex justify-between items-center">
        <span class="badge badge-green text-[9px]">Popular</span>
        <button class="text-[10px] font-bold text-primary-600">Configure</button>
      </div>
    </div>
    <div class="card rounded-2xl p-6 border-t-4 border-blue-500">
      <h3 class="font-bold text-sm mb-2">Reducing Balance</h3>
      <p class="text-[10px] text-gray-500 mb-4">Interest is calculated on the remaining principal balance of the loan.</p>
      <div class="flex justify-between items-center">
        <span class="badge badge-blue text-[9px]">Advanced</span>
        <button class="text-[10px] font-bold text-primary-600">Configure</button>
      </div>
    </div>
    <div class="card rounded-2xl p-6 border-t-4 border-purple-500">
      <h3 class="font-bold text-sm mb-2">Declining Balance</h3>
      <p class="text-[10px] text-gray-500 mb-4">Interest decreases over time as the principal is repaid.</p>
      <div class="flex justify-between items-center">
        <span class="badge badge-purple text-[9px]">Flexible</span>
        <button class="text-[10px] font-bold text-primary-600">Configure</button>
      </div>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Global Interest Settings</h3>
    <div class="space-y-4 max-w-md">
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold">Default Annual Interest Rate (%)</span>
        <input type="number" value="18" class="w-20 form-input input-field text-center" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
      </div>
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold">Interest Grace Period (Days)</span>
        <input type="number" value="0" class="w-20 form-input input-field text-center" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
      </div>
      <button class="w-full py-2.5 rounded-xl bg-primary-600 text-white font-bold text-xs">Save Global Settings</button>
    </div>
  </div>
</div>
@endsection
