@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     COMMUNICATION MODULE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Communication Module</h2>
  </div>

  <!-- 📱 SMS Notifications -->
  <div class="space-y-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      <div class="lg:col-span-2 card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4">Send Broadcast SMS</h3>
        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="form-label">Recipient Group</label>
              <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
                <option>All Members (1,243)</option>
                <option>Active Loan Holders (420)</option>
                <option>Dormant Members (85)</option>
                <option>New Members - Last 30 Days (12)</option>
              </select>
            </div>
            <div>
              <label class="form-label">Sender ID</label>
              <input type="text" value="FEEDTAN" class="form-input input-field" disabled :class="darkMode?'bg-[#0a140e] border-[#1a3328] opacity-60':''">
            </div>
          </div>
          <div>
            <label class="form-label">Message Content</label>
            <textarea class="form-input input-field h-32" placeholder="Ndg Mwanachama, Kumbuka kurejesha mkopo wako kabla ya tarehe..."></textarea>
            <div class="flex justify-between items-center mt-1">
              <p class="text-[10px] text-gray-500">Characters: 0/160 (1 Credit)</p>
              <button class="text-primary-600 text-[10px] font-bold">Insert Placeholder {Name}</button>
            </div>
          </div>
          <button class="px-6 py-2.5 rounded-xl bg-primary-600 text-white text-xs font-bold shadow-lg shadow-primary-900/20">Send Broadcast SMS</button>
        </div>
      </div>
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4 text-center">SMS Statistics</h3>
        <div class="space-y-4">
          <div class="p-4 rounded-xl bg-primary-50 dark:bg-primary-900/10 text-center border border-primary-100 dark:border-primary-900">
            <p class="text-xs text-gray-500 mb-1">Available Credits</p>
            <p class="text-3xl font-bold text-primary-600">4,280</p>
          </div>
          <div class="grid grid-cols-2 gap-2 text-center">
            <div class="p-3 rounded-xl bg-gray-50 dark:bg-gray-800/30">
              <p class="text-[9px] text-gray-500 uppercase">Sent (MTD)</p>
              <p class="text-sm font-bold">12,450</p>
            </div>
            <div class="p-3 rounded-xl bg-gray-50 dark:bg-gray-800/30">
              <p class="text-[9px] text-gray-500 uppercase">Delivery %</p>
              <p class="text-sm font-bold">98.2%</p>
            </div>
          </div>
          <button class="w-full py-2.5 rounded-xl border-2 border-primary-500 text-primary-600 font-bold text-xs hover:bg-primary-500 hover:text-white transition-all">Top Up Credits</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 📧 Email Alerts -->
  <div x-show="activePage==='comm-email'" class="space-y-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-6">Email Campaign Manager</h3>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="p-4 rounded-xl border-2 border-primary-500 bg-primary-50 dark:bg-primary-900/10">
          <p class="text-[10px] font-bold uppercase text-primary-600 mb-1">Total Emails</p>
          <p class="text-xl font-bold">45,800</p>
        </div>
        <div class="p-4 rounded-xl border">
          <p class="text-[10px] font-bold uppercase text-gray-500 mb-1">Open Rate</p>
          <p class="text-xl font-bold text-blue-500">24.5%</p>
        </div>
        <div class="p-4 rounded-xl border">
          <p class="text-[10px] font-bold uppercase text-gray-500 mb-1">Click Rate</p>
          <p class="text-xl font-bold text-green-500">8.2%</p>
        </div>
        <div class="p-4 rounded-xl border">
          <p class="text-[10px] font-bold uppercase text-gray-500 mb-1">Bounce Rate</p>
          <p class="text-xl font-bold text-red-500">1.1%</p>
        </div>
      </div>
      <button class="px-6 py-2.5 rounded-xl bg-primary-600 text-white text-xs font-bold">Compose New Email Campaign</button>
    </div>
  </div>

  <!-- 💬 WhatsApp Integration -->
  <div x-show="activePage==='comm-whatsapp'" class="space-y-4">
    <div class="card rounded-2xl p-8 text-center max-w-2xl mx-auto">
      <div class="w-16 h-16 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
        <i class="fa-brands fa-whatsapp"></i>
      </div>
      <h3 class="text-xl font-bold mb-2">WhatsApp Business API</h3>
      <p class="text-sm text-gray-500 mb-6">Connect your official WhatsApp Business account to send automated loan alerts and interactive chatbots.</p>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left mb-8">
        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/30 flex gap-3">
          <i class="fa-solid fa-check-circle text-green-500 mt-1"></i>
          <div>
            <p class="text-xs font-bold">Interactive Buttons</p>
            <p class="text-[10px] text-gray-500">Allow members to check balance via WhatsApp.</p>
          </div>
        </div>
        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/30 flex gap-3">
          <i class="fa-solid fa-check-circle text-green-500 mt-1"></i>
          <div>
            <p class="text-xs font-bold">Rich Media</p>
            <p class="text-[10px] text-gray-500">Send PDF statements directly to WhatsApp.</p>
          </div>
        </div>
      </div>
      <button class="px-8 py-3 rounded-xl bg-green-600 text-white font-bold text-sm hover:bg-green-700 transition-all shadow-lg shadow-green-900/20">Connect WhatsApp Account</button>
    </div>
  </div>

  <!-- ⏰ Automated Reminders -->
  <div x-show="activePage==='comm-reminders'" class="space-y-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-6">Automation Rules</h3>
      <div class="space-y-4">
        <div class="flex items-center justify-between p-4 rounded-2xl border hover:border-primary-500 transition-all cursor-pointer">
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg"><i class="fa-solid fa-bell"></i></div>
            <div>
              <p class="text-sm font-bold">Repayment Due Reminder</p>
              <p class="text-xs text-gray-500">Trigger: 3 Days before due date • Channel: SMS & Email</p>
            </div>
          </div>
          <button class="relative w-11 h-6 rounded-full bg-primary-500 shadow-inner"><span class="absolute top-0.5 right-0.5 w-5 h-5 rounded-full bg-white shadow"></span></button>
        </div>
        <div class="flex items-center justify-between p-4 rounded-2xl border hover:border-primary-500 transition-all cursor-pointer">
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg"><i class="fa-solid fa-circle-check"></i></div>
            <div>
              <p class="text-sm font-bold">Loan Disbursement Alert</p>
              <p class="text-xs text-gray-500">Trigger: On approval • Channel: SMS & WhatsApp</p>
            </div>
          </div>
          <button class="relative w-11 h-6 rounded-full bg-primary-500 shadow-inner"><span class="absolute top-0.5 right-0.5 w-5 h-5 rounded-full bg-white shadow"></span></button>
        </div>
        <div class="flex items-center justify-between p-4 rounded-2xl border opacity-50 grayscale cursor-not-allowed">
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center text-lg"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div>
              <p class="text-sm font-bold">Default Warning</p>
              <p class="text-xs text-gray-500">Trigger: T+7 Days overdue • Channel: SMS & Email</p>
            </div>
          </div>
          <button class="relative w-11 h-6 rounded-full bg-gray-300 shadow-inner"><span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow"></span></button>
        </div>
      </div>
    </div>
  </div>

  <!-- ⚙️ Configurations -->
  <div x-show="activePage==='comm-config'" class="space-y-4">
    <div class="card rounded-2xl p-6 max-w-3xl">
      <h3 class="font-bold text-sm mb-6">Communication Settings</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="form-label">SMS Gateway API Key</label>
          <input type="password" value="••••••••••••••••••••" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
        </div>
        <div>
          <label class="form-label">Default Sender ID</label>
          <input type="text" value="FEEDTAN" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328]':''">
        </div>
        <div class="col-span-2">
          <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-900/30 border border-dashed border-primary-500">
            <div>
              <p class="text-xs font-bold">Automatic Sync</p>
              <p class="text-[10px] text-gray-500">Automatically sync member phone numbers with SMS gateway.</p>
            </div>
            <button class="px-4 py-2 rounded-lg bg-primary-600 text-white text-[10px] font-bold">Sync Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
