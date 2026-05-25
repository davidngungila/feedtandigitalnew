@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Data Encryption</h2>
    <span class="badge badge-green"><i class="fa-solid fa-lock mr-2"></i> System Fully Encrypted</span>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Database Encryption</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between p-3 rounded-xl bg-green-500/10 border border-green-500/20">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-database text-green-500"></i>
            <div>
              <p class="text-xs font-bold">At-Rest Encryption</p>
              <p class="text-[10px] text-gray-500">AES-256-CBC Protection</p>
            </div>
          </div>
          <span class="text-[10px] font-bold text-green-600">ACTIVE</span>
        </div>
        <div class="flex items-center justify-between p-3 rounded-xl bg-blue-500/10 border border-blue-500/20">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-shield-halved text-blue-500"></i>
            <div>
              <p class="text-xs font-bold">Field-Level Encryption</p>
              <p class="text-[10px] text-gray-500">Sensitive member data encrypted</p>
            </div>
          </div>
          <span class="text-[10px] font-bold text-blue-600">ACTIVE</span>
        </div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Storage & Backups</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-cloud-arrow-up text-primary-500"></i>
            <div>
              <p class="text-xs font-bold">Encrypted Backups</p>
              <p class="text-[10px] text-gray-500">Daily off-site encrypted backups</p>
            </div>
          </div>
          <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
        </div>
        <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-file-shield text-primary-500"></i>
            <div>
              <p class="text-xs font-bold">Document Encryption</p>
              <p class="text-[10px] text-gray-500">KYC documents are encrypted</p>
            </div>
          </div>
          <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
