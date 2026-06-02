<!-- ============================================================
     SIDEBAR
     ============================================================ -->
<aside :class="[sidebarOpen?'mobile-open':'', 'sidebar sidebar-bg fixed lg:relative h-screen z-50 flex flex-col transition-all duration-300 w-[260px]']"
       class="sidebar-bg">

  <!-- Sidebar Header -->
  <div class="flex items-center justify-between p-4 border-b border-primary-800/50 flex-shrink-0">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg bg-primary-400 flex items-center justify-center flex-shrink-0">
        <i class="fa-solid fa-leaf text-primary-900 text-sm"></i>
      </div>
      <div>
        <p class="text-white font-bold text-sm leading-tight">FEEDTAN</p>
        <p class="text-primary-300 text-[10px]">Management Information System</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav id="sidebar-nav" class="flex-1 min-h-0 overflow-y-scroll py-3 px-2 space-y-0.5">

    <!-- Dashboard -->
    <template x-if="hasAccess('dashboard')">
      <a href="{{ route('dashboard') }}" :class="activePage==='dashboard'?'bg-primary-600 text-white':'text-primary-200 hover:bg-primary-800/50 hover:text-white'"
              class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-150 group">
        <i class="fa-solid fa-gauge-high w-4 text-center flex-shrink-0"></i>
        <span class="font-medium">Dashboard</span>
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
                    <span class="font-medium" x-text="item.label"></span>
                  </div>
                  <i :class="openDropdowns.includes(item.id)?'fa-solid fa-chevron-up':'fa-solid fa-chevron-down'" class="text-[10px] text-primary-400"></i>
                </button>
                <!-- Children -->
                <div :class="openDropdowns.includes(item.id)?'max-h-[500px]':'max-h-0'" class="overflow-hidden transition-all duration-300 ml-3">
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
                <span class="font-medium" x-text="item.label"></span>
              </a>
            </template>
          </div>
        </template>
      </div>
    </template>
  </nav>

</aside>
