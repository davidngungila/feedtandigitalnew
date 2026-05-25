@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Branch Performance</h2>
    <div class="flex gap-2">
      <select class="text-xs px-3 py-1.5 rounded-lg border" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-white border-gray-200'">
        <option>All Branches</option>
        <option>Dar es Salaam</option>
        <option>Arusha</option>
        <option>Mwanza</option>
      </select>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-6" :class="darkMode?'text-primary-200':'text-primary-800'">Loan Disbursement by Branch</h3>
      <div class="h-64 flex items-end justify-between gap-4 px-4">
        <!-- Mock Chart Bars -->
        <div class="flex-1 flex flex-col items-center gap-2">
          <div class="w-full bg-primary-600 rounded-t-lg" style="height: 80%"></div>
          <span class="text-[10px] font-bold">DSM</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-2">
          <div class="w-full bg-primary-400 rounded-t-lg" style="height: 45%"></div>
          <span class="text-[10px] font-bold">Arusha</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-2">
          <div class="w-full bg-primary-500 rounded-t-lg" style="height: 60%"></div>
          <span class="text-[10px] font-bold">Mwanza</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-2">
          <div class="w-full bg-primary-300 rounded-t-lg" style="height: 30%"></div>
          <span class="text-[10px] font-bold">Dodoma</span>
        </div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Branch Efficiency</h3>
      <div class="space-y-4">
        <div>
          <div class="flex justify-between text-xs mb-1"><span>Target Achievement</span><span class="font-bold">88%</span></div>
          <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-2">
            <div class="bg-green-500 h-2 rounded-full" style="width: 88%"></div>
          </div>
        </div>
        <div>
          <div class="flex justify-between text-xs mb-1"><span>Collection Rate</span><span class="font-bold">94%</span></div>
          <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-2">
            <div class="bg-blue-500 h-2 rounded-full" style="width: 94%"></div>
          </div>
        </div>
        <div>
          <div class="flex justify-between text-xs mb-1"><span>PAR > 30 Days</span><span class="font-bold text-red-500">4.2%</span></div>
          <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-2">
            <div class="bg-red-500 h-2 rounded-full" style="width: 15%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
