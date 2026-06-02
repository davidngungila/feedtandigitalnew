<!-- TOP NAVBAR -->
<header class="navbar-bg flex items-center justify-between px-4 h-14 flex-shrink-0 relative z-30">
  <!-- Left: Hamburger + Breadcrumb -->
  <div class="flex items-center gap-3">
    <button @click="sidebarOpen=!sidebarOpen" class="p-2 rounded-lg transition-colors lg:hidden"
            :class="darkMode?'text-primary-300 hover:bg-primary-900':'text-primary-700 hover:bg-primary-50'">
      <i class="fa-solid fa-bars text-sm"></i>
    </button>
    <button @click="sidebarCollapsed=!sidebarCollapsed" class="p-2 rounded-lg transition-colors hidden lg:block"
            :class="darkMode?'text-primary-300 hover:bg-primary-900':'text-primary-700 hover:bg-primary-50'">
      <i class="fa-solid fa-bars text-sm"></i>
    </button>
    <div class="hidden sm:flex items-center gap-2">
      <span class="text-xs font-medium" :class="darkMode?'text-primary-400':'text-primary-500'">FEEDTAN Management Information System</span>
      <i class="fa-solid fa-chevron-right text-[10px]" :class="darkMode?'text-primary-700':'text-primary-300'"></i>
      <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'" x-text="getPageTitle()"></span>
    </div>
  </div>

  <!-- Center: Search -->
  <div class="hidden md:flex flex-1 max-w-xs mx-4">
    <div class="relative w-full">
      <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-xs" :class="darkMode?'text-primary-500':'text-primary-400'"></i>
      <input type="text" placeholder="Search members, loans, transactions..."
             class="form-input input-field pl-8 text-xs py-2"
             :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-primary-50 border-primary-200 text-primary-900'"/>
    </div>
  </div>

  <!-- Right: Actions -->
  <div class="flex items-center gap-1 sm:gap-2">
    <!-- Dark mode toggle -->
    <button @click="darkMode=!darkMode;saveDarkMode()" class="p-1.5 sm:p-2 rounded-lg transition-all duration-200"
            :class="darkMode?'text-yellow-400 hover:bg-yellow-900/30':'text-primary-600 hover:bg-primary-100'">
      <i :class="darkMode?'fa-solid fa-sun':'fa-solid fa-moon'" class="text-xs sm:text-sm"></i>
    </button>

    <!-- Quick Actions -->
    <button @click="showModal('quickAction')" class="flex items-center gap-2 px-2 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-[10px] sm:text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus"></i><span class="hidden sm:inline">Quick Action</span>
    </button>

    <!-- Notifications -->
    <div class="relative" x-data="{open:false}">
      <button @click="open=!open" class="relative p-2 rounded-lg transition-colors"
              :class="darkMode?'text-primary-300 hover:bg-primary-900/50':'text-primary-700 hover:bg-primary-100'">
        <i class="fa-solid fa-bell text-sm"></i>
        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border border-white dark:border-primary-900"></span>
      </button>
      <div x-show="open" @click.away="open=false" x-transition
           class="absolute right-0 top-10 w-80 rounded-2xl shadow-2xl z-50 overflow-hidden"
           :class="darkMode?'bg-[#0d1f16] border border-[#1a3328]':'bg-white border border-primary-100'">
        <div class="p-4 border-b" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
          <div class="flex justify-between items-center">
            <h3 class="font-bold text-sm" :class="darkMode?'text-white':'text-primary-900'">Notifications</h3>
            <span class="badge badge-green text-[10px]">8 New</span>
          </div>
        </div>
        <div class="max-h-72 overflow-y-auto">
          <template x-for="n in notifications.slice(0,5)" :key="n.id">
            <div class="p-3 border-b transition-colors cursor-pointer"
                 :class="[darkMode?'border-[#1a3328] hover:bg-primary-900/30':'border-primary-50 hover:bg-primary-50',n.unread?'':'opacity-60']">
              <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-xs"
                     :class="n.type==='loan'?'bg-blue-900 text-blue-300':n.type==='deposit'?'bg-green-900 text-green-300':'bg-yellow-900 text-yellow-300'">
                  <i :class="n.icon"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-xs font-semibold truncate" :class="darkMode?'text-white':'text-primary-900'" x-text="n.title"></p>
                  <p class="text-[11px] mt-0.5" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="n.message"></p>
                  <p class="text-[10px] mt-1 text-primary-500" x-text="n.time"></p>
                </div>
                <div x-show="n.unread" class="w-2 h-2 rounded-full bg-primary-500 flex-shrink-0 mt-1"></div>
              </div>
            </div>
          </template>
        </div>
        <div class="p-3">
          <button @click="navigate('notif-sms');open=false" class="w-full text-center text-xs text-primary-500 hover:text-primary-400 font-semibold py-1">View all notifications →</button>
        </div>
      </div>
    </div>

    <!-- User Profile -->
    <div class="relative" x-data="{open:false}">
      <button @click="open=!open" class="flex items-center gap-2 p-1.5 rounded-xl transition-colors"
              :class="darkMode?'hover:bg-primary-900/50':'hover:bg-primary-100'">
        <div class="w-8 h-8 rounded-full overflow-hidden bg-gradient-to-br from-primary-400 to-primary-700 flex items-center justify-center text-white font-bold text-sm">
          <template x-if="currentUser.profile_image">
            <img :src="currentUser.profile_image" class="w-full h-full object-cover">
          </template>
          <template x-if="!currentUser.profile_image">
            <span x-text="currentUser.name ? currentUser.name.charAt(0) : ''"></span>
          </template>
        </div>
        <div class="hidden lg:block text-left">
          <p class="text-xs font-semibold leading-tight" :class="darkMode?'text-white':'text-primary-900'" x-text="currentUser.name"></p>
          <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-primary-500'" x-text="currentUser.email"></p>
        </div>
        <i class="fa-solid fa-chevron-down text-[10px] hidden lg:block" :class="darkMode?'text-primary-400':'text-primary-400'"></i>
      </button>
      <div x-show="open" @click.away="open=false" x-transition
           class="absolute right-0 top-11 w-56 rounded-2xl shadow-2xl z-50 py-2"
           :class="darkMode?'bg-[#0d1f16] border border-[#1a3328]':'bg-white border border-primary-100'">
        <div class="px-4 py-2 border-b" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
          <p class="text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="currentUser.name"></p>
          <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="currentUser.email"></p>
        </div>
        <button @click="navigate('settings');open=false" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs hover:bg-primary-50 dark:hover:bg-primary-900/30 transition-colors text-left"
                :class="darkMode?'text-primary-300':'text-gray-700'">
          <i class="fa-solid fa-gear w-4"></i> Settings
        </button>
        <button @click="navigate('profile');open=false" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs hover:bg-primary-50 dark:hover:bg-primary-900/30 transition-colors text-left"
                :class="darkMode?'text-primary-300':'text-gray-700'">
          <i class="fa-solid fa-user w-4"></i> My Profile
        </button>
        <div class="border-t my-1" :class="darkMode?'border-[#1a3328]':'border-primary-100'"></div>
        <button @click="logout();open=false" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-left">
          <i class="fa-solid fa-right-from-bracket w-4"></i> Logout
        </button>
      </div>
    </div>
  </div>
</header>
