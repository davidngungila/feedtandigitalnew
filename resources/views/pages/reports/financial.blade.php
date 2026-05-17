@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     REPORTS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Financial Reports</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <template x-for="r in reportTypes" :key="r.id">
      <div class="card rounded-2xl p-5 cursor-pointer hover:border-primary-500 transition-all border"
           :class="darkMode?'border-[#1a3328] hover:border-primary-600':'border-transparent hover:border-primary-400'">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" :style="`background:${r.color}22;color:${r.color}`">
          <i :class="r.icon" class="text-lg"></i>
        </div>
        <h3 class="font-bold text-sm mb-1" :class="darkMode?'text-white':'text-primary-900'" x-text="r.title"></h3>
        <p class="text-xs mb-4" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="r.desc"></p>
        <div class="flex gap-2">
          <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-semibold bg-primary-600 text-white hover:bg-primary-500 transition-colors">
            <i class="fa-solid fa-file-pdf"></i> PDF
          </button>
          <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-semibold border transition-colors"
                  :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">
            <i class="fa-solid fa-file-excel"></i> Excel
          </button>
          <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-semibold border transition-colors"
                  :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">
            <i class="fa-solid fa-print"></i>
          </button>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
