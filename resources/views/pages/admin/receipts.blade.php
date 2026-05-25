@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Auto-Generated Receipts</h2>
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl border" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-white'">
        <span class="text-[10px] font-bold text-gray-500">Auto-Send:</span>
        <button @click="receiptSettings.auto_send = !receiptSettings.auto_send" 
                class="relative w-8 h-4 rounded-full transition-colors"
                :class="receiptSettings.auto_send ? 'bg-primary-500' : 'bg-gray-300'">
          <span class="absolute top-0.5 w-3 h-3 bg-white rounded-full transition-transform"
                :class="receiptSettings.auto_send ? 'right-0.5' : 'left-0.5'"></span>
        </button>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Receipt Customization</h3>
      <div class="space-y-4">
        <div>
          <label class="form-label">Receipt Header / Logo</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-xl" :class="darkMode?'border-primary-900/50 bg-primary-950/20':'border-gray-200 bg-gray-50'">
            <div class="space-y-1 text-center">
              <i class="fa-solid fa-cloud-arrow-up text-2xl text-primary-500 mb-2"></i>
              <div class="flex text-xs text-gray-600">
                <label class="relative cursor-pointer rounded-md font-bold text-primary-600 hover:text-primary-500">
                  <span>Upload a logo</span>
                  <input type="file" class="sr-only">
                </label>
              </div>
              <p class="text-[10px] text-gray-500">PNG, JPG up to 2MB</p>
            </div>
          </div>
        </div>
        <div>
          <label class="form-label">Receipt Footer Note</label>
          <textarea x-model="receiptSettings.footer" rows="3" class="form-input input-field resize-none" placeholder="Thank you for choosing Feedtan Digital..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
        </div>
        <button @click="saveReceiptSettings()" class="w-full py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold text-xs transition-all">
          Save Receipt Settings
        </button>
      </div>
    </div>

    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Recent Receipts Sent</h3>
      <div class="space-y-3">
        <template x-for="i in 5">
          <div class="p-3 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-50 bg-white'">
            <div class="flex items-center gap-3">
              <i class="fa-solid fa-file-invoice text-primary-500"></i>
              <div>
                <p class="text-xs font-bold">REC-#88291-2026</p>
                <p class="text-[9px] text-gray-500">Sent to: john.doe@example.com</p>
              </div>
            </div>
            <div class="text-right">
              <p class="text-xs font-bold">TZS 45,000</p>
              <button class="text-[10px] text-primary-600 font-bold hover:underline">View PDF</button>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</div>
@endsection
