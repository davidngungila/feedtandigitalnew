<!DOCTYPE html>
<html lang="en" :class="{'dark': darkMode}" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'FeedTan Community Microfinance Group')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              primary: { 50:'#ecfdf5',100:'#d1fae5',200:'#a7f3d0',300:'#6ee7b7',400:'#34d399',500:'#10b981',600:'#059669',700:'#047857',800:'#065f46',900:'#064e3b',950:'#022c22' },
              dark: { 800:'#0f1a14',850:'#111f17',900:'#0a140e',card:'#0d1f16',border:'#1a3328' }
            },
            fontFamily: { sans:['Plus Jakarta Sans','sans-serif'], mono:['Plus Jakarta Sans','monospace'] },
            animation: { 'fade-in':'fadeIn 0.4s ease','slide-in':'slideIn 0.3s ease','count-up':'countUp 1.5s ease','pulse-slow':'pulse 3s infinite','spin-slow':'spin 4s linear infinite','bounce-subtle':'bounceSubtle 2s infinite' },
            keyframes: { fadeIn:{from:{opacity:0,transform:'translateY(10px)'},to:{opacity:1,transform:'translateY(0)'}}, slideIn:{from:{opacity:0,transform:'translateX(-20px)'},to:{opacity:1,transform:'translateX(0)'}}, bounceSubtle:{from:{transform:'translateY(0)'},'50%':{transform:'translateY(-4px)'},to:{transform:'translateY(0)'}} }
          }
        }
      }
    </script>

    @include('partials.styles')
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full" x-data="FeedtanApp({{ json_encode($initialData ?? []) }})" :class="darkMode ? 'dark bg-[#0a140e]' : 'bg-[#f0fdf4]'">
    @include('partials.toasts')

    <!-- Loading Overlay -->
    <div x-show="isLoading" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-[9999] flex items-center justify-center">
      <div class="absolute inset-0 backdrop-blur-md" :class="darkMode ? 'bg-[#0a140e]/80' : 'bg-[#f0fdf4]/80'"></div>
      <div class="relative flex flex-col items-center gap-4 z-10">
        <div class="w-16 h-16 rounded-2xl bg-primary-600 flex items-center justify-center shadow-lg shadow-primary-600/40">
          <i class="fa-solid fa-spinner fa-spin text-white text-2xl"></i>
        </div>
        <p class="text-sm font-semibold" :class="darkMode ? 'text-primary-300' : 'text-primary-800'">Loading, please wait...</p>
      </div>
    </div>

    @yield('content')

    @include('partials.modals')
    @include('partials.scripts')
</body>
</html>
