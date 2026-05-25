@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Number Generation Rules</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      Save Rules
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="p-4 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
        <h3 class="text-xs font-bold mb-3 uppercase text-primary-600">Member ID Format</h3>
        <div class="space-y-3">
          <div><label class="text-[10px] text-gray-500">Prefix</label><input type="text" value="MEM-" class="form-input text-xs p-1.5 w-full rounded border"/></div>
          <div><label class="text-[10px] text-gray-500">Start Number</label><input type="number" value="1000" class="form-input text-xs p-1.5 w-full rounded border"/></div>
          <p class="text-[10px] font-mono text-gray-400">Example: MEM-1001</p>
        </div>
      </div>
      <div class="p-4 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
        <h3 class="text-xs font-bold mb-3 uppercase text-primary-600">Loan ID Format</h3>
        <div class="space-y-3">
          <div><label class="text-[10px] text-gray-500">Prefix</label><input type="text" value="LN-" class="form-input text-xs p-1.5 w-full rounded border"/></div>
          <div><label class="text-[10px] text-gray-500">Include Year</label><button class="relative w-8 h-4 bg-primary-500 rounded-full ml-2"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button></div>
          <p class="text-[10px] font-mono text-gray-400">Example: LN-2026-001</p>
        </div>
      </div>
      <div class="p-4 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
        <h3 class="text-xs font-bold mb-3 uppercase text-primary-600">Transaction ID</h3>
        <div class="space-y-3">
          <div><label class="text-[10px] text-gray-500">Prefix</label><input type="text" value="TXN-" class="form-input text-xs p-1.5 w-full rounded border"/></div>
          <div><label class="text-[10px] text-gray-500">Digits</label><input type="number" value="8" class="form-input text-xs p-1.5 w-full rounded border"/></div>
          <p class="text-[10px] font-mono text-gray-400">Example: TXN-99283741</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
