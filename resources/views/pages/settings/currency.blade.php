@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Currency Settings</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Save Changes
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Base Currency</h3>
      <div class="space-y-4">
        <div>
          <label class="form-label">Currency Name</label>
          <input type="text" value="Tanzanian Shilling" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">Currency Code</label>
          <input type="text" value="TZS" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">Currency Symbol</label>
          <input type="text" value="TZS" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Formatting</h3>
      <div class="space-y-4">
        <div>
          <label class="form-label">Decimal Places</label>
          <input type="number" value="0" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label">Thousand Separator</label>
          <input type="text" value="," class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold">Show Symbol Before Amount</span>
          <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
