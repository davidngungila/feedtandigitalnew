@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     COMMUNICATION SETTINGS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Communication Settings</h2>
  </div>

  <div class="card rounded-2xl overflow-hidden">
    <!-- Tabs Header -->
    <div class="flex border-b" :class="darkMode?'border-primary-900/50 bg-primary-950/20':'border-gray-100 bg-gray-50/50'">
      <button @click="commTab='email'" 
              class="px-6 py-4 text-xs font-bold transition-all border-b-2"
              :class="commTab==='email' ? (darkMode?'border-primary-500 text-primary-400 bg-primary-900/20':'border-primary-600 text-primary-700 bg-white') : (darkMode?'border-transparent text-primary-600 hover:text-primary-400':'border-transparent text-gray-500 hover:text-primary-600')">
        <i class="fa-solid fa-envelope mr-2"></i> Email Configuration
      </button>
      <button @click="commTab='sms'" 
              class="px-6 py-4 text-xs font-bold transition-all border-b-2"
              :class="commTab==='sms' ? (darkMode?'border-primary-500 text-primary-400 bg-primary-900/20':'border-primary-600 text-primary-700 bg-white') : (darkMode?'border-transparent text-primary-600 hover:text-primary-400':'border-transparent text-gray-500 hover:text-primary-600')">
        <i class="fa-solid fa-comment-sms mr-2"></i> SMS Gateway
      </button>
    </div>

    <div class="p-6">
      <!-- Email Settings Tab -->
      <div x-show="commTab==='email'" class="space-y-6">
        <div class="flex items-center justify-between">
          <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">SMTP Settings</h3>
          <button @click="saveCommSettings('email')" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-[11px] font-semibold transition-all shadow-lg shadow-primary-600/20">
            Save Email Config
          </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">SMTP Host</label>
            <input type="text" x-model="commSettingsForm.email.smtp_host" placeholder="smtp.mailtrap.io" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">SMTP Port</label>
            <input type="number" x-model="commSettingsForm.email.smtp_port" placeholder="2525" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Encryption</label>
            <select x-model="commSettingsForm.email.smtp_encryption" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
              <option value="tls">TLS</option>
              <option value="ssl">SSL</option>
              <option value="none">None</option>
            </select>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">SMTP Username</label>
            <input type="text" x-model="commSettingsForm.email.smtp_user" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">SMTP Password</label>
            <input type="password" x-model="commSettingsForm.email.smtp_pass" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">From Address</label>
            <input type="email" x-model="commSettingsForm.email.from_email" placeholder="noreply@feedtan.co.tz" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
        </div>

        <!-- Existing Email Configs Table -->
        <div class="mt-8">
          <h4 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-500':'text-primary-700'">Existing Configurations</h4>
          <div class="overflow-x-auto rounded-xl border" :class="darkMode?'border-primary-900/50':'border-gray-100'">
            <table class="w-full text-xs">
              <thead>
                <tr :class="darkMode?'bg-primary-950/40 text-primary-400':'bg-gray-50 text-gray-600'">
                  <th class="text-left p-3 font-bold">Setting Key</th>
                  <th class="text-left p-3 font-bold">Value</th>
                  <th class="text-left p-3 font-bold">Last Updated</th>
                </tr>
              </thead>
              <tbody>
                <template x-for="s in systemSettings.email" :key="s.id">
                  <tr class="border-t" :class="darkMode?'border-primary-900/30 hover:bg-primary-900/10 text-primary-300':'border-gray-50 hover:bg-gray-50 text-gray-700'">
                    <td class="p-3 font-mono" x-text="s.key"></td>
                    <td class="p-3">
                      <span x-text="s.key.includes('pass') ? '********' : s.value"></span>
                    </td>
                    <td class="p-3 opacity-60" x-text="new Date(s.updated_at).toLocaleDateString()"></td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SMS Settings Tab -->
      <div x-show="commTab==='sms'" class="space-y-6">
        <div class="flex items-center justify-between">
          <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">SMS Gateway Settings</h3>
          <button @click="saveCommSettings('sms')" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-[11px] font-semibold transition-all shadow-lg shadow-primary-600/20">
            Save SMS Config
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">SMS Provider</label>
            <select x-model="commSettingsForm.sms.provider" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
              <option value="beem">Beem Solutions</option>
              <option value="twilio">Twilio</option>
              <option value="nexmo">Nexmo (Vonage)</option>
              <option value="other">Other HTTP API</option>
            </select>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Sender ID</label>
            <input type="text" x-model="commSettingsForm.sms.sender_id" placeholder="FEEDTAN" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">API Key</label>
            <input type="password" x-model="commSettingsForm.sms.api_key" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">API Secret / Auth Token</label>
            <input type="password" x-model="commSettingsForm.sms.api_secret" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
        </div>

        <!-- Existing SMS Configs Table -->
        <div class="mt-8">
          <h4 class="text-xs font-bold uppercase tracking-wider mb-3" :class="darkMode?'text-primary-500':'text-primary-700'">Existing SMS Configurations</h4>
          <div class="overflow-x-auto rounded-xl border" :class="darkMode?'border-primary-900/50':'border-gray-100'">
            <table class="w-full text-xs">
              <thead>
                <tr :class="darkMode?'bg-primary-950/40 text-primary-400':'bg-gray-50 text-gray-600'">
                  <th class="text-left p-3 font-bold">Setting Key</th>
                  <th class="text-left p-3 font-bold">Value</th>
                  <th class="text-left p-3 font-bold">Last Updated</th>
                </tr>
              </thead>
              <tbody>
                <template x-for="s in systemSettings.sms" :key="s.id">
                  <tr class="border-t" :class="darkMode?'border-primary-900/30 hover:bg-primary-900/10 text-primary-300':'border-gray-50 hover:bg-gray-50 text-gray-700'">
                    <td class="p-3 font-mono" x-text="s.key"></td>
                    <td class="p-3">
                      <span x-text="s.key.includes('key') || s.key.includes('secret') || s.key.includes('token') ? '********' : s.value"></span>
                    </td>
                    <td class="p-3 opacity-60" x-text="new Date(s.updated_at).toLocaleDateString()"></td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
