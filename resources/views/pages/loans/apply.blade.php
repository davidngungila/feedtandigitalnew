@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     LOAN APPLICATION PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Loan Application</h2>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 card rounded-2xl p-6 space-y-5">
      <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Loan Application Form</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Applicant Member *</label>
          <input type="text" class="form-input input-field" placeholder="Search member..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Loan Type *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Emergency Loan</option><option>Development Loan</option>
            <option>Business Loan</option><option>Education Loan</option>
            <option>Housing Loan</option>
          </select>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Principal Amount (TZS) *</label>
          <input type="number" x-model="loanCalc.principal" @input="calcLoan()" class="form-input input-field" placeholder="e.g. 5,000,000" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Interest Rate (% p.a.) *</label>
          <input type="number" x-model="loanCalc.rate" @input="calcLoan()" class="form-input input-field" value="18" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Repayment Period (Months) *</label>
          <input type="number" x-model="loanCalc.months" @input="calcLoan()" class="form-input input-field" value="12" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Disbursement Date *</label>
          <input type="date" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Guarantor 1 *</label>
          <input type="text" class="form-input input-field" placeholder="Search guarantor..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div>
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Guarantor 2</label>
          <input type="text" class="form-input input-field" placeholder="Search guarantor..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
        </div>
        <div class="md:col-span-2">
          <label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Loan Purpose *</label>
          <textarea rows="2" class="form-input input-field" placeholder="Describe the purpose of this loan..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
        </div>
      </div>
      <div class="flex justify-end gap-3">
        <button class="px-6 py-2.5 rounded-xl border text-xs font-semibold transition-colors"
                :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
        <button @click="showToast('Loan application submitted for approval!','success')"
                class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
          <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Submit Application
        </button>
      </div>
    </div>

    <!-- Loan Calculator -->
    <div class="space-y-4">
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-4" :class="darkMode?'text-primary-300':'text-primary-700'">
          <i class="fa-solid fa-calculator mr-2"></i>Loan Calculator
        </h3>
        <div class="space-y-3">
          <div class="flex justify-between">
            <span class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Principal</span>
            <span class="text-xs font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS '+(loanCalc.principal||0).toLocaleString()"></span>
          </div>
          <div class="flex justify-between">
            <span class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Total Interest</span>
            <span class="text-xs font-bold  text-yellow-500" x-text="'TZS '+loanCalc.interest.toLocaleString()"></span>
          </div>
          <div class="flex justify-between">
            <span class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Processing Fee (1%)</span>
            <span class="text-xs font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS '+(Math.round((loanCalc.principal||0)*0.01)).toLocaleString()"></span>
          </div>
          <div class="border-t pt-3" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex justify-between">
              <span class="text-xs font-bold" :class="darkMode?'text-primary-200':'text-primary-800'">Total Payable</span>
              <span class="text-sm font-bold  text-primary-500" x-text="'TZS '+loanCalc.total.toLocaleString()"></span>
            </div>
          </div>
          <div class="p-3 rounded-xl" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
            <p class="text-[10px] mb-1" :class="darkMode?'text-primary-400':'text-gray-500'">Monthly Installment</p>
            <p class="text-lg font-bold  text-primary-500" x-text="'TZS '+loanCalc.monthly.toLocaleString()"></p>
          </div>
        </div>
      </div>

      <!-- Eligibility Check -->
      <div class="card rounded-2xl p-5">
        <h3 class="font-bold text-xs mb-3" :class="darkMode?'text-primary-300':'text-primary-700'">
          <i class="fa-solid fa-shield-check mr-2 text-primary-500"></i>Eligibility
        </h3>
        <div class="space-y-2.5">
          <template x-for="e in eligibilityChecks" :key="e.label">
            <div class="flex items-center justify-between">
              <span class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="e.label"></span>
              <i :class="e.pass?'fa-solid fa-circle-check text-green-500':'fa-solid fa-circle-xmark text-red-500'" class="text-sm"></i>
            </div>
          </template>
        </div>
        <div class="mt-3 p-2.5 rounded-xl bg-green-900/20 border border-green-800">
          <p class="text-[11px] text-green-400 font-semibold">✓ Member is eligible for this loan</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
