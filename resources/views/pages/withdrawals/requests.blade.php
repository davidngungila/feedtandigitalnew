@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     WITHDRAWAL PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Withdrawal Requests</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
    <div class="card rounded-xl p-4 border-l-4 border-green-500">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Total Savings</p>
      <p class="text-xl font-bold  mt-1 text-green-500">TZS 4.32B</p>
    </div>
    <div class="card rounded-xl p-4 border-l-4 border-yellow-500">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Held (Collateral)</p>
      <p class="text-xl font-bold  mt-1 text-yellow-500">TZS 1.28B</p>
    </div>
    <div class="card rounded-xl p-4 border-l-4 border-blue-500">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Available</p>
      <p class="text-xl font-bold  mt-1 text-blue-500">TZS 3.04B</p>
    </div>
    <div class="card rounded-xl p-4 border-l-4 border-red-500">
      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Pending Requests</p>
      <p class="text-xl font-bold  mt-1 text-red-500">23</p>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Request Form -->
    <div class="card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">New Withdrawal Request</h3>
      <div class="space-y-3">
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Member *</label>
          <input type="text" class="form-input input-field text-xs" placeholder="Search member..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Account *</label>
          <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>RDA Account</option><option>FLEX Account</option><option>Emergency Fund</option>
          </select>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Amount (TZS) *</label>
          <input type="number" class="form-input input-field text-xs" placeholder="0.00" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Reason *</label>
          <textarea rows="2" class="form-input input-field text-xs" placeholder="Reason for withdrawal..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
        </div>
        <button @click="showToast('Withdrawal request submitted!','success')"
                class="w-full py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
          <i class="fa-solid fa-money-bill-wave mr-2"></i> Submit Request
        </button>
      </div>
    </div>

    <!-- Pending Requests Table -->
    <div class="lg:col-span-2 card rounded-2xl p-5">
      <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Pending Withdrawal Requests</h3>
      <div class="overflow-x-auto">
        <table class="data-table">
          <thead><tr>
            <th class="text-left">Member</th><th class="text-left">Account</th>
            <th class="text-right">Amount</th><th class="text-left">Date</th>
            <th class="text-left">Status</th><th class="text-left">Actions</th>
          </tr></thead>
          <tbody>
            <template x-for="w in withdrawalRequests" :key="w.id">
              <tr class="table-row">
                <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="w.member"></td>
                <td><span class="badge badge-blue text-[10px]" x-text="w.account"></span></td>
                <td class="text-right  text-xs font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS '+w.amount.toLocaleString()"></td>
                <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="w.date"></td>
                <td><span class="badge" :class="w.status==='Pending'?'badge-yellow':w.status==='Approved'?'badge-green':'badge-red'" x-text="w.status"></span></td>
                <td>
                  <div class="flex gap-1" x-show="currentUser.role==='admin'||currentUser.role==='manager'">
                    <button @click="w.status='Approved';showToast('Withdrawal approved!','success')" x-show="w.status==='Pending'"
                            class="p-1.5 rounded-lg text-green-500 hover:bg-green-900/20 text-[11px] transition-colors"><i class="fa-solid fa-check"></i></button>
                    <button @click="w.status='Rejected';showToast('Withdrawal rejected','error')" x-show="w.status==='Pending'"
                            class="p-1.5 rounded-lg text-red-500 hover:bg-red-900/20 text-[11px] transition-colors"><i class="fa-solid fa-xmark"></i></button>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
