<!-- ============================================================
     SIDEBAR
     ============================================================ -->
<aside :class="[sidebarOpen?'mobile-open':'', 'sidebar sidebar-bg fixed lg:relative h-screen z-50 flex flex-col transition-all duration-300',sidebarCollapsed&&window.innerWidth>=1024?'w-16':'w-[260px]']"
       class="sidebar-bg">

  <!-- Sidebar Header -->
  <div class="flex items-center justify-between p-4 border-b border-primary-800/50 flex-shrink-0">
    <div class="flex items-center gap-3" x-show="!sidebarCollapsed || window.innerWidth<1024">
      <div class="w-8 h-8 rounded-lg bg-primary-400 flex items-center justify-center flex-shrink-0">
        <i class="fa-solid fa-leaf text-primary-900 text-sm"></i>
      </div>
      <div x-show="!sidebarCollapsed">
        <p class="text-white font-bold text-sm leading-tight">FEEDTAN</p>
        <p class="text-primary-300 text-[10px]">MICROFINANCE</p>
      </div>
    </div>
    <div x-show="sidebarCollapsed && window.innerWidth>=1024" class="w-8 h-8 rounded-lg bg-primary-400 flex items-center justify-center mx-auto">
      <i class="fa-solid fa-leaf text-primary-900 text-sm"></i>
    </div>
    <button @click="sidebarCollapsed=!sidebarCollapsed" class="text-primary-300 hover:text-white transition-colors hidden lg:block">
      <i :class="sidebarCollapsed?'fa-solid fa-chevron-right':'fa-solid fa-chevron-left'" class="text-xs"></i>
    </button>
  </div>

  <!-- User Info in Sidebar -->
  <div class="p-3 border-b border-primary-800/50 flex-shrink-0" x-show="!sidebarCollapsed">
    <div class="flex items-center gap-3 p-2 rounded-xl bg-primary-800/30">
      <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
           x-text="currentUser.name ? currentUser.name.charAt(0) : ''"></div>
      <div class="min-w-0">
        <p class="text-white text-xs font-semibold truncate" x-text="currentUser.name"></p>
        <span class="role-tag" :class="'role-'+currentUser.role" x-text="currentUser.role ? currentUser.role.charAt(0).toUpperCase() + currentUser.role.slice(1) : ''"></span>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="flex-1 min-h-0 overflow-y-scroll py-3 px-2 space-y-0.5">

    <!-- Dashboard -->
    <template x-if="hasAccess('dashboard')">
      <a href="{{ route('dashboard') }}" :class="activePage==='dashboard'?'bg-primary-600 text-white':'text-primary-200 hover:bg-primary-800/50 hover:text-white'"
              class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-150 group">
        <i class="fa-solid fa-gauge-high w-4 text-center flex-shrink-0"></i>
        <span x-show="!sidebarCollapsed" class="font-medium">Dashboard</span>
      </a>
    </template>

    <!-- Section builder via sidebar items -->
    <template x-for="section in filteredSidebarSections()" :key="section.id">
      <div>
        <template x-for="item in section.items" :key="item.id">
          <div>
            <!-- Has children -->
            <template x-if="item.children">
              <div>
                <button @click="toggleDropdown(item.id)"
                        :class="isChildActive(item)?'bg-primary-800/60 text-white':'text-primary-200 hover:bg-primary-800/40 hover:text-white'"
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all duration-150">
                  <div class="flex items-center gap-3">
                    <i :class="item.icon" class="w-4 text-center flex-shrink-0"></i>
                    <span x-show="!sidebarCollapsed" class="font-medium" x-text="item.label"></span>
                  </div>
                  <i x-show="!sidebarCollapsed" :class="openDropdowns.includes(item.id)?'fa-solid fa-chevron-up':'fa-solid fa-chevron-down'" class="text-[10px] text-primary-400"></i>
                </button>
                <!-- Children -->
                <div :class="openDropdowns.includes(item.id)?'max-h-[500px]':'max-h-0'" class="overflow-hidden transition-all duration-300 ml-3" x-show="!sidebarCollapsed">
                  <template x-for="child in item.children" :key="child.id">
                    <a :href="child.route"
                            :class="activePage===child.id?'bg-primary-600/80 text-white':'text-primary-300 hover:bg-primary-800/30 hover:text-white'"
                            class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-xs transition-all duration-150 mt-0.5">
                      <i class="fa-solid fa-circle text-[6px] flex-shrink-0 ml-1"></i>
                      <span x-text="child.label"></span>
                    </a>
                  </template>
                </div>
              </div>
            </template>

            <!-- No children -->
            <template x-if="!item.children">
              <a :href="item.route"
                      :class="activePage===item.id?'bg-primary-600 text-white':'text-primary-200 hover:bg-primary-800/50 hover:text-white'"
                      class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-150">
                <i :class="item.icon" class="w-4 text-center flex-shrink-0"></i>
                <span x-show="!sidebarCollapsed" class="font-medium" x-text="item.label"></span>
              </a>
            </template>
          </div>
        </template>
      </div>
    </template>
  </nav>

  <!-- Sidebar Footer / Logout -->
  <div class="p-3 border-t border-primary-800/50 flex-shrink-0">
    <button @click="logout()" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-primary-300 hover:bg-red-900/40 hover:text-red-400 transition-all duration-150">
      <i class="fa-solid fa-right-from-bracket w-4 text-center flex-shrink-0"></i>
      <span x-show="!sidebarCollapsed" class="font-medium">Logout</span>
    </button>
  </div>
</aside>
