@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Bulk SMS & Marketing</h2>
    <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-paper-plane"></i> New Campaign
    </button>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 card rounded-2xl p-6 space-y-6">
      <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Send Bulk SMS</h3>
      <div class="space-y-4">
        <div>
          <label class="form-label">Recipient Group</label>
          <select x-model="bulkSmsForm.group" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option value="All Members">All Members</option>
            <option value="Active Borrowers">Active Borrowers</option>
            <option value="High-Value Savers">High-Value Savers</option>
            <option value="Dormant Members">Dormant Members</option>
          </select>
        </div>
        <div>
          <label class="form-label">Message Content</label>
          <textarea x-model="bulkSmsForm.message" rows="4" class="form-input input-field resize-none" placeholder="Enter your message here..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
          <div class="flex justify-between mt-1">
            <span class="text-[10px] text-gray-500" x-text="'Characters: ' + bulkSmsForm.message.length + ' / 160 (' + Math.ceil(bulkSmsForm.message.length / 160) + ' SMS)'"></span>
            <span class="text-[10px] text-primary-600 font-bold cursor-pointer">Use Template <i class="fa-solid fa-chevron-down ml-1"></i></span>
          </div>
        </div>
        <button @click="sendBulkSms()" class="w-full py-3 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold text-sm transition-all shadow-lg shadow-primary-600/20">
          Send to <span x-text="bulkSmsForm.group === 'All Members' ? '1,243' : '450'"></span> Recipients
        </button>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Campaign History</h3>
      <div class="space-y-4">
        <template x-for="i in 3">
          <div class="p-4 rounded-2xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
            <div class="flex justify-between items-start mb-2">
              <h4 class="text-xs font-bold">Monthly Statement Alert</h4>
              <span class="badge badge-green text-[9px]">Delivered</span>
            </div>
            <p class="text-[10px] text-gray-500 line-clamp-2">Dear Member, your monthly statement for May 2024 is now available on the portal.</p>
            <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-100 dark:border-primary-900/30">
              <span class="text-[9px] text-gray-400">12 May, 10:00 AM</span>
              <span class="text-[9px] font-bold text-primary-600">892 Sent</span>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</div>
@endsection
