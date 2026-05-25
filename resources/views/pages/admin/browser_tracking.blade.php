@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Browser Tracking</h2>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="card rounded-2xl p-6 lg:col-span-2">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Browser Distribution</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <i class="fa-brands fa-chrome text-xl text-blue-500"></i>
            <span class="text-sm font-semibold">Google Chrome</span>
          </div>
          <div class="flex items-center gap-4 flex-1 max-w-xs ml-4">
            <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-2">
              <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
            </div>
            <span class="text-xs font-bold">65%</span>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <i class="fa-brands fa-firefox text-xl text-orange-500"></i>
            <span class="text-sm font-semibold">Mozilla Firefox</span>
          </div>
          <div class="flex items-center gap-4 flex-1 max-w-xs ml-4">
            <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-2">
              <div class="bg-orange-500 h-2 rounded-full" style="width: 15%"></div>
            </div>
            <span class="text-xs font-bold">15%</span>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <i class="fa-brands fa-safari text-xl text-blue-400"></i>
            <span class="text-sm font-semibold">Apple Safari</span>
          </div>
          <div class="flex items-center gap-4 flex-1 max-w-xs ml-4">
            <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-2">
              <div class="bg-blue-400 h-2 rounded-full" style="width: 12%"></div>
            </div>
            <span class="text-xs font-bold">12%</span>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <i class="fa-brands fa-edge text-xl text-blue-600"></i>
            <span class="text-sm font-semibold">Microsoft Edge</span>
          </div>
          <div class="flex items-center gap-4 flex-1 max-w-xs ml-4">
            <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-2">
              <div class="bg-blue-600 h-2 rounded-full" style="width: 8%"></div>
            </div>
            <span class="text-xs font-bold">8%</span>
          </div>
        </div>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Security Insights</h3>
      <div class="p-4 rounded-xl bg-yellow-500/10 border border-yellow-500/20 mb-4">
        <div class="flex items-center gap-3 mb-2">
          <i class="fa-solid fa-triangle-exclamation text-yellow-600"></i>
          <span class="text-xs font-bold text-yellow-700">Outdated Browsers</span>
        </div>
        <p class="text-[10px] text-yellow-800">2 members are using outdated browser versions which may pose a security risk.</p>
      </div>
      <div class="p-4 rounded-xl bg-green-500/10 border border-green-500/20">
        <div class="flex items-center gap-3 mb-2">
          <i class="fa-solid fa-shield-check text-green-600"></i>
          <span class="text-xs font-bold text-green-700">Secure Access</span>
        </div>
        <p class="text-[10px] text-green-800">98% of users are using browsers with modern security features enabled.</p>
      </div>
    </div>
  </div>
</div>
@endsection
