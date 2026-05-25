@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     INVESTMENT CERTIFICATES
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Investment Certificates</h2>
      <p class="text-sm mt-0.5" :class="darkMode?'text-primary-400':'text-gray-600'">Download and manage official investment documents</p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <template x-for="inv in activeInvestments" :key="inv.id">
      <div class="card p-0 rounded-2xl overflow-hidden group border" :class="darkMode?'border-[#1a3328]':'border-gray-100'">
        <div class="p-5 border-b flex items-center justify-between" :class="darkMode?'border-[#1a3328] bg-primary-950/20':'border-gray-50 bg-gray-50/50'">
          <span class="text-[10px] font-bold text-primary-600 font-mono" x-text="inv.ref"></span>
          <span class="badge badge-green" x-text="inv.status"></span>
        </div>
        <div class="p-5">
          <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-primary-600 flex items-center justify-center text-white">
              <i class="fa-solid fa-file-contract"></i>
            </div>
            <div>
              <p class="text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="inv.member_name"></p>
              <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="inv.product_name"></p>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-3 mb-5 text-[10px]">
            <div><p class="text-gray-400">Issued On</p><p class="font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="inv.start_date"></p></div>
            <div><p class="text-gray-400">Principal</p><p class="font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS ' + inv.principal.toLocaleString()"></p></div>
          </div>
          <button class="w-full py-2.5 rounded-xl border-2 border-primary-600 text-primary-600 text-xs font-bold hover:bg-primary-600 hover:text-white transition-all flex items-center justify-center gap-2">
            <i class="fa-solid fa-download"></i> Download Certificate
          </button>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
