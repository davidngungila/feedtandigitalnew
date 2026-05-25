@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Compliance Reports</h2>
    <div class="flex gap-2">
      <button class="flex items-center gap-2 px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        <i class="fa-solid fa-download"></i> Export PDF
      </button>
      <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-plus"></i> Generate New Report
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-5 border-t-4 border-green-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">KYC Compliance</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">98.4%</p>
      <p class="text-[10px] text-green-500 mt-1"><i class="fa-solid fa-caret-up"></i> 2.1% improvement</p>
    </div>
    <div class="card rounded-2xl p-5 border-t-4 border-blue-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">AML Coverage</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">100%</p>
      <p class="text-[10px] text-blue-500 mt-1">All transactions screened</p>
    </div>
    <div class="card rounded-2xl p-5 border-t-4 border-yellow-500">
      <p class="text-[10px] font-bold text-gray-400 uppercase">Pending Audits</p>
      <p class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">12</p>
      <p class="text-[10px] text-yellow-500 mt-1">Due by end of month</p>
    </div>
  </div>

  <div class="card rounded-2xl p-6">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Regulatory Compliance Status</h3>
    <div class="space-y-4">
      <div class="flex items-center justify-between p-4 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center"><i class="fa-solid fa-check"></i></div>
          <div>
            <p class="text-sm font-bold">Data Protection Policy</p>
            <p class="text-[10px] text-gray-500">Compliant with Tanzania Data Protection Act</p>
          </div>
        </div>
        <span class="badge badge-green">COMPLIANT</span>
      </div>
      <div class="flex items-center justify-between p-4 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center"><i class="fa-solid fa-check"></i></div>
          <div>
            <p class="text-sm font-bold">Anti-Money Laundering (AML)</p>
            <p class="text-[10px] text-gray-500">Regular screening and reporting active</p>
          </div>
        </div>
        <span class="badge badge-green">COMPLIANT</span>
      </div>
      <div class="flex items-center justify-between p-4 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <div class="flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-yellow-500/20 text-yellow-500 flex items-center justify-center"><i class="fa-solid fa-clock"></i></div>
          <div>
            <p class="text-sm font-bold">Annual Financial Audit</p>
            <p class="text-[10px] text-gray-500">Scheduled for June 2026</p>
          </div>
        </div>
        <span class="badge badge-yellow">UPCOMING</span>
      </div>
    </div>
  </div>
</div>
@endsection
