@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Backup & Restore</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-database mr-2"></i> Create Manual Backup
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Automatic Backups</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold">Enable Daily Cloud Backup</span>
          <button class="relative w-8 h-4 bg-primary-500 rounded-full"><span class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full"></span></button>
        </div>
        <div>
          <label class="form-label">Backup Retention (Days)</label>
          <input type="number" value="30" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Backup History</h3>
      <div class="space-y-3">
        <div class="p-3 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-file-zipper text-primary-500"></i>
            <div>
              <p class="text-xs font-bold">Backup_2026_05_24.sql.gz</p>
              <p class="text-[9px] text-gray-500">Size: 45.2 MB • Daily Auto</p>
            </div>
          </div>
          <button class="text-[10px] font-bold text-primary-600">Restore</button>
        </div>
        <div class="p-3 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-file-zipper text-primary-500"></i>
            <div>
              <p class="text-xs font-bold">Backup_2026_05_23.sql.gz</p>
              <p class="text-[9px] text-gray-500">Size: 44.8 MB • Daily Auto</p>
            </div>
          </div>
          <button class="text-[10px] font-bold text-primary-600">Restore</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
