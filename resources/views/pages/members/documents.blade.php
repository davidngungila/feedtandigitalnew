@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Member Documents</h2>
    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-upload mr-2"></i> Upload New
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <template x-for="i in 8">
      <div class="card rounded-2xl p-4 flex flex-col items-center text-center group cursor-pointer hover:border-primary-500 transition-all border"
           :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <i class="fa-solid fa-file-pdf text-red-500 text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
        <h4 class="text-xs font-bold truncate w-full">ID_Card_John_Doe.pdf</h4>
        <p class="text-[9px] text-gray-400 mt-1">Uploaded 12 May 2026</p>
        <div class="mt-4 flex gap-2 w-full">
          <button class="flex-1 py-1.5 rounded-lg bg-gray-100 dark:bg-primary-900/30 text-[10px] font-bold">View</button>
          <button class="flex-1 py-1.5 rounded-lg bg-primary-600 text-white text-[10px] font-bold">Download</button>
        </div>
      </div>
    </template>
  </div>
</div>
@endsection
