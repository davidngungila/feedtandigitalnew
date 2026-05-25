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
      <form action="{{ route('loans.store') }}" method="POST" class="space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="form-label font-bold text-xs mb-1 block" :class="darkMode?'text-primary-300':'text-primary-700'">Applicant Member *</label>
            <select name="member_id" required class="form-input input-field w-full rounded-xl border p-2 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                <option value="">-- Select Member --</option>
                @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->user->name }} ({{ $member->member_no }})</option>
                @endforeach
            </select>
          </div>
          <div>
            <label class="form-label font-bold text-xs mb-1 block" :class="darkMode?'text-primary-300':'text-primary-700'">Loan Type *</label>
            <select name="loan_type" required class="form-input input-field w-full rounded-xl border p-2 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
              <option value="Emergency Loan">Emergency Loan</option>
              <option value="Development Loan">Development Loan</option>
              <option value="Business Loan">Business Loan</option>
              <option value="Education Loan">Education Loan</option>
              <option value="Housing Loan">Housing Loan</option>
            </select>
          </div>
          <div>
            <label class="form-label font-bold text-xs mb-1 block" :class="darkMode?'text-primary-300':'text-primary-700'">Principal Amount (TZS) *</label>
            <input type="number" name="principal" required x-model="loanCalc.principal" @input="calcLoan()" class="form-input input-field w-full rounded-xl border p-2 text-sm" placeholder="e.g. 5,000,000" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label font-bold text-xs mb-1 block" :class="darkMode?'text-primary-300':'text-primary-700'">Interest Rate (% p.a.) *</label>
            <input type="number" step="0.01" name="interest_rate" required x-model="loanCalc.rate" @input="calcLoan()" class="form-input input-field w-full rounded-xl border p-2 text-sm" value="18" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label font-bold text-xs mb-1 block" :class="darkMode?'text-primary-300':'text-primary-700'">Repayment Period (Months) *</label>
            <input type="number" name="term_months" required x-model="loanCalc.months" @input="calcLoan()" class="form-input input-field w-full rounded-xl border p-2 text-sm" value="12" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div>
            <label class="form-label font-bold text-xs mb-1 block" :class="darkMode?'text-primary-300':'text-primary-700'">Preferred Disbursement Date *</label>
            <input type="date" class="form-input input-field w-full rounded-xl border p-2 text-sm" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
          </div>
          <div class="md:col-span-2">
            <label class="form-label font-bold text-xs mb-1 block" :class="darkMode?'text-primary-300':'text-primary-700'">Loan Purpose *</label>
            <textarea name="purpose" rows="2" required class="form-input input-field w-full rounded-xl border p-2 text-sm" placeholder="Describe the purpose of this loan..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
          </div>
        </div>
        <div class="flex justify-end gap-3">
          <a href="{{ route('loans.active') }}" class="px-6 py-2.5 rounded-xl border text-xs font-semibold transition-colors text-center"
                  :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</a>
          <button type="submit"
                  class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
            <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Submit Application
          </button>
        </div>
      </form>
    </div>

    <!-- Loan Calculator -->
    <div class="space-y-4">
      <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
        <h3 class="font-bold text-xs mb-4" :class="darkMode?'text-primary-300':'text-primary-700'">
          <i class="fa-solid fa-calculator mr-2"></i>Loan Calculator
        </h3>
        <div class="space-y-3">
          <div class="flex justify-between">
            <span class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Principal</span>
            <span class="text-xs font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS '+(parseFloat(loanCalc.principal)||0).toLocaleString()"></span>
          </div>
          <div class="flex justify-between">
            <span class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Total Interest</span>
            <span class="text-xs font-bold  text-yellow-500" x-text="'TZS '+(Math.round((parseFloat(loanCalc.principal)||0)*(parseFloat(loanCalc.rate)||0)/100)).toLocaleString()"></span>
          </div>
          <div class="flex justify-between">
            <span class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Processing Fee (1%)</span>
            <span class="text-xs font-bold " :class="darkMode?'text-white':'text-primary-900'" x-text="'TZS '+(Math.round((parseFloat(loanCalc.principal)||0)*0.01)).toLocaleString()"></span>
          </div>
          <div class="border-t pt-3" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex justify-between">
              <span class="text-xs font-bold" :class="darkMode?'text-primary-200':'text-primary-800'">Total Payable</span>
              <span class="text-sm font-bold  text-primary-500" x-text="'TZS '+( (parseFloat(loanCalc.principal)||0) + (Math.round((parseFloat(loanCalc.principal)||0)*(parseFloat(loanCalc.rate)||0)/100)) ).toLocaleString()"></span>
            </div>
          </div>
          <div class="p-3 rounded-xl" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
            <p class="text-[10px] mb-1" :class="darkMode?'text-primary-400':'text-gray-500'">Monthly Installment</p>
            <p class="text-lg font-bold  text-primary-500" x-text="'TZS '+(Math.round( ((parseFloat(loanCalc.principal)||0) + ((parseFloat(loanCalc.principal)||0)*(parseFloat(loanCalc.rate)||0)/100)) / (parseInt(loanCalc.months)||1) )).toLocaleString()"></p>
          </div>
        </div>
      </div>

      <!-- Eligibility Check (Visual only) -->
      <div class="card rounded-2xl p-5 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
        <h3 class="font-bold text-xs mb-3" :class="darkMode?'text-primary-300':'text-primary-700'">
          <i class="fa-solid fa-shield-check mr-2 text-primary-500"></i>Eligibility
        </h3>
        <div class="space-y-2.5">
            <div class="flex items-center justify-between">
              <span class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'">Active Membership</span>
              <i class="fa-solid fa-circle-check text-green-500 text-sm"></i>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'">Savings Ratio</span>
              <i class="fa-solid fa-circle-check text-green-500 text-sm"></i>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'">Credit Score</span>
              <i class="fa-solid fa-circle-check text-green-500 text-sm"></i>
            </div>
        </div>
        <div class="mt-3 p-2.5 rounded-xl bg-green-900/20 border border-green-800">
          <p class="text-[11px] text-green-400 font-semibold">✓ Member is eligible for this loan</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
