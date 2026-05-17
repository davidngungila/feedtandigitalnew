@extends('layouts.app')

@section('content')
<!-- ============================================================
     MAIN APP WRAPPER
     ============================================================ -->
<div x-cloak class="h-screen flex flex-row overflow-hidden">

    @include('partials.sidebar')

    <!-- ============================================================
         MAIN CONTENT AREA
         ============================================================ -->
    <div class="flex-1 flex flex-col min-h-0 overflow-hidden main-content">

        @include('partials.navbar')

        <!-- PAGES CONTAINER -->
        <main class="flex-1 min-h-0 overflow-y-scroll p-4 lg:p-6" :class="darkMode?'bg-[#0a140e]':'bg-[#f0fdf4]'">
            <div class="min-h-full flex flex-col">
                <div class="flex-1">
                    @yield('dashboard-content')
                </div>
                @include('partials.footer')
            </div>
        </main>
    </div>

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen=false"
         class="fixed inset-0 bg-black/60 z-40 lg:hidden backdrop-blur-sm" x-transition></div>
</div>
@endsection
