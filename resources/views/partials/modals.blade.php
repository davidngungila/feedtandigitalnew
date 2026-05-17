<!-- ============================================================
     MODALS
     ============================================================ -->

<!-- Add Member Modal -->
<div x-cloak x-show="activeModal==='addMember'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Register New Member</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm" :class="darkMode?'text-primary-300':'text-gray-500'"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div class="col-span-2"><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Full Name *</label>
        <input class="form-input input-field text-xs" placeholder="Jina Kamili" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Phone *</label>
        <input class="form-input input-field text-xs" placeholder="+255 7XX XXX XXX" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">NIDA *</label>
        <input class="form-input input-field text-xs" placeholder="NIDA Number" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Region *</label>
        <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Dar es Salaam</option><option>Mwanza</option><option>Arusha</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Membership Type</label>
        <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Regular</option><option>Group</option><option>Junior</option></select></div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="activeModal=null;showToast('Member registered successfully!','success')"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-user-plus mr-1.5"></i> Register
      </button>
    </div>
  </div>
</div>

<!-- Repayment Modal -->
<div x-cloak x-show="activeModal==='repayment'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Record Loan Repayment</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="space-y-3">
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Loan Reference</label>
        <input class="form-input input-field text-xs" value="LN/2024/00156" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Amount Paid (TZS)</label>
        <input type="number" class="form-input input-field text-xs" placeholder="0.00" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Payment Channel</label>
        <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Cash</option><option>M-Pesa</option><option>Bank Transfer</option></select></div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="activeModal=null;showToast('Repayment recorded successfully!','success')"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-money-bill mr-1.5"></i> Record Payment
      </button>
    </div>
  </div>
</div>

<!-- Add Investment Modal -->
<div x-cloak x-show="activeModal==='addInvestment'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">New Investment</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="space-y-3">
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Member</label>
        <input class="form-input input-field text-xs" placeholder="Search member..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Investment Plan</label>
        <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Fixed Deposit – 12 Months (18% p.a.)</option>
          <option>Fixed Deposit – 24 Months (20% p.a.)</option>
          <option>Treasury Bond Fund (16% p.a.)</option>
        </select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Amount (TZS)</label>
        <input type="number" class="form-input input-field text-xs" placeholder="Min: TZS 500,000" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="activeModal=null;showToast('Investment created successfully!','success')"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-chart-line mr-1.5"></i> Create Investment
      </button>
    </div>
  </div>
</div>

<!-- Quick Action Modal -->
<div x-cloak x-show="activeModal==='quickAction'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6" style="max-width:400px">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Quick Actions</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <button @click="navigate('member-register');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-user-plus text-xl text-primary-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Add Member</span>
      </button>
      <button @click="navigate('savings-deposit');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-money-bill-transfer text-xl text-green-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Deposit</span>
      </button>
      <button @click="navigate('loan-apply');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-file-invoice-dollar text-xl text-blue-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Apply Loan</span>
      </button>
      <button @click="navigate('withdrawal-requests');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-money-bill-wave text-xl text-yellow-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Withdrawal</span>
      </button>
    </div>
  </div>
</div>

<!-- Add User Modal -->
<div x-cloak x-show="activeModal==='addUser'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Add System User</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div class="col-span-2"><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Full Name *</label>
        <input class="form-input input-field text-xs" placeholder="Full Name" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Email *</label>
        <input type="email" class="form-input input-field text-xs" placeholder="user@feedtan.co.tz" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Role *</label>
        <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Admin</option><option>Manager</option><option>Teller</option><option>Auditor</option></select></div>
      <div class="col-span-2"><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Password *</label>
        <input type="password" class="form-input input-field text-xs" placeholder="Temporary password" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="activeModal=null;showToast('User account created successfully!','success')"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-user-shield mr-1.5"></i> Create User
      </button>
    </div>
  </div>
</div>
