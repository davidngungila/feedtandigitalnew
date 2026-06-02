@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4 flex flex-col items-center justify-center min-h-[80vh]">
    <div class="mb-8">
        <div class="relative mx-auto w-48 h-48">
            <div class="absolute inset-0 bg-blue-500/10 dark:bg-blue-500/10 rounded-full animate-pulse"></div>
            <div class="relative flex items-center justify-center w-full h-full">
                <span class="text-[120px] font-extrabold text-blue-600 dark:text-blue-400 leading-none">503</span>
            </div>
        </div>
    </div>
    
    <h1 class="text-3xl font-bold text-[#064e3b] dark:text-[#ecfdf5] mb-4 text-center">Service Unavailable</h1>
    
    <p class="text-[#6b7280] dark:text-[#6ee7b7] mb-8 text-sm leading-relaxed text-center max-w-md">
        Sorry, we're down for maintenance. Please check back soon.
    </p>
    
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-[#064e3b] hover:bg-[#059669] text-white text-sm font-semibold transition-all duration-200 shadow-lg shadow-[#064e3b]/20">
            <i class="fa-solid fa-home mr-2"></i> Go to Login
        </a>
        <button onclick="window.location.reload()" class="px-6 py-3 rounded-xl border-2 border-[#064e3b] dark:border-[#10b981] text-[#064e3b] dark:text-[#10b981] hover:bg-[#064e3b]/10 dark:hover:bg-[#10b981]/10 text-sm font-semibold transition-all duration-200">
            <i class="fa-solid fa-rotate-right mr-2"></i> Check Again
        </button>
    </div>
    
    <div class="mt-12 flex justify-center gap-8 text-xs text-[#6b7280]/60 dark:text-[#6ee7b7]/40">
        <div class="flex flex-col items-center gap-2">
            <i class="fa-solid fa-lock text-xl"></i>
            <span>Secure</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <i class="fa-solid fa-shield-halved text-xl"></i>
            <span>Protected</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <i class="fa-solid fa-headset text-xl"></i>
            <span>Support</span>
        </div>
    </div>
</div>
@endsection
