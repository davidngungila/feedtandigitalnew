@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     FORMULA ENGINE PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Formula Engine</h2>
  </div>

  <!-- 💰 1. LOAN FORMULAS -->
  <div class="space-y-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-6 flex items-center gap-2">
          <i class="fa-solid fa-money-bill-wave text-primary-500"></i> Loan Interest Calculation
        </h3>
        <div class="space-y-4">
          <div class="p-4 rounded-xl border-2" :class="darkMode?'border-primary-900/50 bg-primary-900/10':'border-primary-100 bg-primary-50'">
            <p class="text-xs font-bold mb-2">Reducing Balance Interest</p>
            <p class="text-[10px] text-gray-500 leading-relaxed mb-3">Interest is calculated on the remaining principal balance after each repayment.</p>
            <div class="p-2 rounded bg-white dark:bg-black/20 font-mono text-[10px]" :class="darkMode?'text-primary-300':'text-primary-700'">
              Interest = (Remaining Principal * Rate * Time)
            </div>
          </div>
          <div class="p-4 rounded-xl border border-primary-100 dark:border-primary-900">
            <p class="text-xs font-bold mb-2">Flat Rate Interest</p>
            <p class="text-[10px] text-gray-500 leading-relaxed mb-3">Interest is calculated once on the total principal for the entire term.</p>
            <div class="p-2 rounded bg-white dark:bg-black/20 font-mono text-[10px]" :class="darkMode?'text-primary-300':'text-primary-700'">
              Interest = (Principal * Rate * Total Time) / 100
            </div>
          </div>
        </div>
      </div>
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-6 flex items-center gap-2">
          <i class="fa-solid fa-calculator text-blue-500"></i> EMI / Monthly Installment
        </h3>
        <div class="p-4 rounded-xl border border-primary-100 bg-gray-50 dark:bg-gray-900/30">
          <p class="text-[11px] font-bold mb-4">Standard Amortization Formula:</p>
          <div class="p-3 rounded bg-white dark:bg-black/40 text-center font-mono text-xs mb-4" :class="darkMode?'text-blue-300':'text-blue-700'">
            EMI = [P x R x (1+R)^N] / [(1+R)^N-1]
          </div>
          <div class="grid grid-cols-2 gap-4 text-[11px]">
            <div><p class="text-gray-500">P (Principal)</p><p class="font-bold">TZS 5,000,000</p></div>
            <div><p class="text-gray-500">R (Monthly Rate)</p><p class="font-bold">1.5% (18% p.a)</p></div>
            <div><p class="text-gray-500">N (Tenure)</p><p class="font-bold">12 Months</p></div>
            <div class="col-span-2 pt-2 border-t border-primary-100 dark:border-primary-900 flex justify-between items-center">
              <span class="font-bold">Total Repayment Amount:</span>
              <span class="text-lg font-bold text-primary-600">TZS 5,499,600</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 🏦 2. SAVINGS FORMULAS -->
  <div x-show="activePage==='formula-savings'" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="card rounded-2xl p-5">
        <h4 class="text-xs font-bold mb-3 text-primary-600 uppercase">Daily Accumulation</h4>
        <p class="text-[10px] text-gray-500 mb-4">Calculates interest daily based on the end-of-day balance.</p>
        <div class="p-2 rounded bg-gray-50 dark:bg-black/20 font-mono text-[9px]">
          Daily_Int = (Balance * Annual_Rate) / 365
        </div>
      </div>
      <div class="card rounded-2xl p-5">
        <h4 class="text-xs font-bold mb-3 text-blue-600 uppercase">Compound Growth</h4>
        <p class="text-[10px] text-gray-500 mb-4">Monthly compounding where interest is added to principal.</p>
        <div class="p-2 rounded bg-gray-50 dark:bg-black/20 font-mono text-[9px]">
          A = P(1 + r/n)^(nt)
        </div>
      </div>
      <div class="card rounded-2xl p-5">
        <h4 class="text-xs font-bold mb-3 text-orange-600 uppercase">Fixed Deposit Returns</h4>
        <p class="text-[10px] text-gray-500 mb-4">Calculates maturity value for locked investment terms.</p>
        <div class="p-2 rounded bg-gray-50 dark:bg-black/20 font-mono text-[9px]">
          Returns = Principal * (1 + Rate * Term)
        </div>
      </div>
    </div>
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-4">Member Balance Calculation</h3>
      <p class="text-xs text-gray-500 mb-4">How the system reconciles member balances across multiple accounts.</p>
      <div class="p-4 rounded-xl border border-dashed" :class="darkMode?'border-primary-900':'border-primary-200'">
        <div class="flex items-center justify-between text-xs mb-2">
          <span>Net Balance =</span>
          <span class="font-bold">Total Savings - (Blocked Amount + Lien)</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ⚠️ 3. PENALTIES & FEES -->
  <div x-show="activePage==='formula-penalties'" class="space-y-4">
    <div class="card rounded-2xl p-6 overflow-hidden">
      <table class="data-table">
        <thead>
          <tr>
            <th>Fee Type</th><th>Calculation Basis</th><th>Standard Rate</th><th>Grace Period</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td class="text-xs font-bold">Late Payment Penalty</td>
            <td class="text-[10px]">Daily Compound on Arrears</td>
            <td class="text-xs font-bold text-red-500">1.5% / Day</td>
            <td class="text-[10px]">3 Days</td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Loan Processing Fee</td>
            <td class="text-[10px]">Percentage of Principal</td>
            <td class="text-xs font-bold">2.0%</td>
            <td class="text-[10px]">N/A</td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Account Maintenance</td>
            <td class="text-[10px]">Fixed Monthly Charge</td>
            <td class="text-xs font-bold">TZS 1,000</td>
            <td class="text-[10px]">N/A</td>
          </tr>
          <tr class="table-row">
            <td class="text-xs font-bold">Default Penalty</td>
            <td class="text-[10px]">One-time Flat Penalty</td>
            <td class="text-xs font-bold text-red-600">TZS 25,000</td>
            <td class="text-[10px]">7 Days</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- 📆 4. TIME-BASED RULES -->
  <div x-show="activePage==='formula-time'" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4">Interest Cycles</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-900/40">
            <div><p class="text-xs font-bold">Daily Rule</p><p class="text-[10px] text-gray-500">Calculated at 23:59 EAT</p></div>
            <span class="badge badge-green">Active</span>
          </div>
          <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-900/40">
            <div><p class="text-xs font-bold">Monthly Cycle</p><p class="text-[10px] text-gray-500">Applied on 1st of every month</p></div>
            <span class="badge badge-green">Active</span>
          </div>
        </div>
      </div>
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4">Overdue & Grace Periods</h3>
        <div class="space-y-3">
          <div class="flex justify-between text-xs"><span>Grace Period Rule:</span><span class="font-bold">T+3 Days</span></div>
          <div class="w-full h-2 rounded-full bg-gray-100 dark:bg-gray-800"><div class="h-full w-3/4 rounded-full bg-primary-500"></div></div>
          <p class="text-[10px] text-gray-500">Penalty kicks in automatically on T+4 if repayment is not verified.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- 📊 5. INVESTMENT FORMULAS -->
  <div x-show="activePage==='formula-investments'" class="space-y-4">
    <div class="card rounded-2xl p-6">
      <h3 class="font-bold text-sm mb-6">Investment ROI & Dividend Distribution</h3>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="space-y-4">
          <div class="p-4 rounded-xl border border-primary-100 dark:border-primary-900">
            <h4 class="text-xs font-bold mb-2">Profit Sharing Ratio (PSR)</h4>
            <p class="text-[10px] text-gray-500 mb-3">Allocates investment profits between Member and Group.</p>
            <div class="flex items-center gap-4">
              <div class="flex-1 h-8 rounded-lg bg-primary-600 flex items-center justify-center text-white text-[10px] font-bold">Member: 70%</div>
              <div class="flex-1 h-8 rounded-lg bg-primary-900 flex items-center justify-center text-white text-[10px] font-bold">Group: 30%</div>
            </div>
          </div>
        </div>
        <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900">
          <h4 class="text-xs font-bold mb-2 text-blue-600">Dividend Calculation</h4>
          <p class="text-[10px] text-blue-800 dark:text-blue-300 mb-3">Dividends distributed based on share capital weight.</p>
          <div class="font-mono text-[10px] p-2 bg-white dark:bg-black/20 rounded">
            Div = (Member_Shares / Total_Shares) * Net_Profit
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 🧾 6. SYSTEM CALCULATIONS -->
  <div x-show="activePage==='formula-system'" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4">Credit & Risk Scoring</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900 bg-primary-900/10':'border-primary-100 bg-primary-50'">
            <div>
              <p class="text-xs font-bold">Savings Multiplier (x3)</p>
              <p class="text-[10px] text-gray-500">Maximum loan is 3x member savings</p>
            </div>
            <span class="badge badge-blue">Weight: 40%</span>
          </div>
          <div class="flex items-center justify-between p-3 rounded-xl border" :class="darkMode?'border-primary-900 bg-primary-900/10':'border-primary-100 bg-primary-50'">
            <div>
              <p class="text-xs font-bold">Repayment History</p>
              <p class="text-[10px] text-gray-500">Based on last 5 loan cycles</p>
            </div>
            <span class="badge badge-blue">Weight: 50%</span>
          </div>
        </div>
      </div>
      <div class="card rounded-2xl p-6">
        <h3 class="font-bold text-sm mb-4">System Balance Reconciliation</h3>
        <div class="p-4 rounded-xl border border-red-100 bg-red-50 dark:bg-red-900/10">
          <p class="text-[10px] text-red-800 dark:text-red-300 font-mono">Formula: Σ(Member_Balances) == Total_Liability_Account</p>
          <div class="mt-4 pt-4 border-t border-red-200 dark:border-red-900">
            <div class="flex justify-between text-[11px] mb-2"><span>Current Total Balances:</span><span class="font-bold">TZS 1.24B</span></div>
            <div class="flex justify-between text-[11px] mb-2"><span>Accounting GL Balance:</span><span class="font-bold">TZS 1.24B</span></div>
            <div class="flex justify-between text-xs pt-2 border-t border-red-200 dark:border-red-900"><span class="font-bold text-green-600 uppercase">Status:</span><span class="badge badge-green">Balanced</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
