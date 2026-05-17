<!-- ============================================================
     LOGIN SCREEN
     ============================================================ -->
<div id="loginScreen" x-show="!loggedIn" x-transition class="fixed inset-0 z-50 flex items-center justify-center"
     :class="darkMode ? 'bg-[#0a140e]' : 'bg-gradient-to-br from-primary-900 via-primary-800 to-primary-700'">
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full opacity-10" :class="darkMode ? 'bg-primary-400' : 'bg-white'"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full opacity-10" :class="darkMode ? 'bg-primary-500' : 'bg-white'"></div>
    <div class="absolute top-1/3 right-1/4 w-64 h-64 rounded-full opacity-5" :class="darkMode ? 'bg-primary-300' : 'bg-white'"></div>
  </div>
  <div class="relative w-full max-w-md mx-4">
    <div class="card rounded-2xl p-8 shadow-2xl" :class="darkMode ? 'bg-[#0d1f16] border border-[#1a3328]' : 'bg-white'">
      <!-- Logo -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary-600 mb-4 shadow-lg">
          <i class="fa-solid fa-leaf text-white text-2xl"></i>
        </div>
        <h1 class="text-2xl font-bold" :class="darkMode?'text-white':'text-primary-900'">FEEDTAN MICROFINANCE</h1>
        <p class="text-sm mt-1" :class="darkMode?'text-primary-300':'text-primary-600'">Group Management System</p>
      </div>

      <!-- Login form -->
      <form @submit.prevent="doLogin()">
        <!-- Email -->
        <div class="mb-4">
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Email Address</label>
          <div class="relative">
            <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-sm" :class="darkMode?'text-primary-400':'text-primary-500'"></i>
            <input type="email" x-model="loginEmail" required placeholder="admin@feedtan.co.tz"
                   class="form-input input-field pl-9"
                   :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200 text-primary-900'"/>
          </div>
        </div>

        <!-- Password -->
        <div class="mb-6">
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Password</label>
          <div class="relative">
            <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-sm" :class="darkMode?'text-primary-400':'text-primary-500'"></i>
            <input type="password" x-model="loginPassword" required placeholder="••••••••"
                   class="form-input input-field pl-9"
                   :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200 text-primary-900'"/>
          </div>
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full py-3 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-semibold text-sm transition-all duration-200 hover:shadow-lg hover:shadow-primary-900/30 active:scale-95">
          <i class="fa-solid fa-right-to-bracket mr-2"></i> Sign In
        </button>
      </form>

      <!-- Demo accounts (for testing) -->
      <div class="mt-5 p-3 rounded-xl" :class="darkMode?'bg-primary-900/30 border border-primary-900':'bg-primary-50 border border-primary-100'">
        <p class="text-xs font-bold mb-2" :class="darkMode?'text-primary-300':'text-primary-700'">Test Credentials (password: 'password'):</p>
        <div class="grid grid-cols-1 gap-1">
          <button @click="loginEmail='admin@feedtan.co.tz';loginPassword='password';doLogin()" class="text-xs py-1 px-2 rounded-lg text-left transition-colors"
                  :class="darkMode?'hover:bg-primary-800 text-primary-300':'hover:bg-primary-100 text-primary-700'">
            Admin: admin@feedtan.co.tz
          </button>
          <button @click="loginEmail='member@feedtan.co.tz';loginPassword='password';doLogin()" class="text-xs py-1 px-2 rounded-lg text-left transition-colors"
                  :class="darkMode?'hover:bg-primary-800 text-primary-300':'hover:bg-primary-100 text-primary-700'">
            Member: member@feedtan.co.tz
          </button>
        </div>
      </div>

      <!-- Dark mode toggle -->
      <div class="mt-4 flex justify-center">
        <button @click="darkMode=!darkMode;saveDarkMode()" class="text-xs flex items-center gap-2 transition-colors"
                :class="darkMode?'text-primary-300':'text-primary-600'">
          <i :class="darkMode?'fa-solid fa-sun':'fa-solid fa-moon'"></i>
          <span x-text="darkMode?'Switch to Light Mode':'Switch to Dark Mode'"></span>
        </button>
      </div>
    </div>

    <!-- Login Footer -->
    <div class="mt-8 text-center text-[10px] font-medium" :class="darkMode ? 'text-primary-500' : 'text-white/80'">
        <p>&copy; 2026 FeedTan Digital Microfinance System</p>
        <p class="mt-1">Smart & Secure Financial Platform | Powered by FeedTan Digital Solutions</p>
    </div>
  </div>
</div>
