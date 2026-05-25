@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Approval Workflow</h2>
    <button class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
      <i class="fa-solid fa-plus mr-2"></i> Add Stage
    </button>
  </div>

  <div class="card rounded-2xl p-6">
    <div class="space-y-4">
      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">1</div>
        <div class="flex-1 p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-sm font-bold">Document Verification</p>
            <p class="text-[10px] text-gray-500">Assigned to: Loan Officer • Required: KYC, Income Proof</p>
          </div>
          <span class="badge badge-blue">Mandatory</span>
        </div>
      </div>
      <div class="flex justify-center h-4"><div class="w-0.5 h-full bg-gray-300"></div></div>
      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">2</div>
        <div class="flex-1 p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-sm font-bold">Credit Risk Assessment</p>
            <p class="text-[10px] text-gray-500">Assigned to: Risk Manager • Automated Score > 600</p>
          </div>
          <span class="badge badge-blue">Mandatory</span>
        </div>
      </div>
      <div class="flex justify-center h-4"><div class="w-0.5 h-full bg-gray-300"></div></div>
      <div class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">3</div>
        <div class="flex-1 p-4 rounded-xl border flex items-center justify-between" :class="darkMode?'border-primary-900/30 bg-primary-900/10':'border-gray-100 bg-gray-50/30'">
          <div>
            <p class="text-sm font-bold">Final Approval</p>
            <p class="text-[10px] text-gray-500">Assigned to: Branch Manager • For loans > TZS 5M</p>
          </div>
          <span class="badge badge-yellow">Conditional</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
