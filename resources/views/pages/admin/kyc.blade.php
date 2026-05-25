@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">KYC Verification & Compliance</h2>
  
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <div class="lg:col-span-3 card rounded-2xl p-5">
      <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Pending KYC Approvals</h3>
        <div class="flex gap-2">
           <input type="text" placeholder="Search members..." class="px-3 py-1.5 rounded-xl border text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-white border-gray-200'"/>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="data-table">
          <thead>
            <tr>
              <th class="text-left">Member</th>
              <th class="text-left">NIDA / ID</th>
              <th class="text-left">Docs</th>
              <th class="text-left">Risk Level</th>
              <th class="text-left">Status</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="k in kycVerifications" :key="k.id">
              <tr class="table-row">
                <td class="text-xs font-semibold" x-text="k.member ? k.member.user.name : 'Unknown Member'"></td>
                <td class="text-xs font-mono" x-text="k.document_number"></td>
                <td class="text-xs text-primary-600 hover:underline cursor-pointer"><i class="fa-solid fa-file-pdf mr-1"></i> View</td>
                <td><span class="badge" :class="'badge-'+k.risk_level.toLowerCase()" x-text="k.risk_level"></span></td>
                <td><span class="badge" :class="'badge-'+k.status.toLowerCase()" x-text="k.status"></span></td>
                <td>
                  <div class="flex gap-2">
                    <button @click="kycUpdateForm = { id: k.id, status: 'Approved', notes: k.notes }; showModal('kycUpdate')" class="text-green-600 text-[10px] font-bold hover:underline">Review</button>
                  </div>
                </td>
              </tr>
            </template>
            <template x-if="kycVerifications.length === 0">
              <tr>
                <td colspan="6" class="text-center py-8 text-xs text-gray-500 italic">No KYC verifications found</td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="space-y-4">
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-4" :class="darkMode?'text-primary-300':'text-primary-700'">Compliance Summary</h3>
        <div class="space-y-4">
          <div>
            <div class="flex justify-between text-[10px] mb-1">
              <span class="font-bold">KYC Verified</span>
              <span>92%</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-1">
              <div class="bg-green-500 h-1 rounded-full" style="width: 92%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between text-[10px] mb-1">
              <span class="font-bold">AML Screening</span>
              <span>100%</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-primary-900/30 rounded-full h-1">
              <div class="bg-primary-500 h-1 rounded-full" style="width: 100%"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="card rounded-2xl p-5 border-l-4 border-red-500">
        <h3 class="font-bold text-xs text-red-600 mb-2">AML Alert!</h3>
        <p class="text-[10px] text-gray-500">3 transactions flagged for high-risk monitoring in the last 24 hours.</p>
        <button @click="navigate('admin-aml')" class="mt-3 text-[10px] font-bold text-primary-600 hover:underline">Review Alerts <i class="fa-solid fa-arrow-right ml-1"></i></button>
      </div>
    </div>
  </div>
</div>
@endsection
