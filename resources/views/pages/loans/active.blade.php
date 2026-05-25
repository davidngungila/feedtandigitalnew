@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     ACTIVE LOANS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Active Loans</h2>
    <div class="flex gap-2">
      <a href="{{ route('loans.apply') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-plus"></i> New Loan
      </a>
    </div>
  </div>

  <!-- Loan Summary Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
    <div class="card rounded-xl p-4 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Active Loans</p>
      <p class="text-xl font-bold mt-1" :class="darkMode?'text-white':'text-primary-900'">{{ $stats['active_count'] }}</p>
    </div>
    <div class="card rounded-xl p-4 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Total Disbursed</p>
      <p class="text-xl font-bold mt-1 text-primary-500">TZS {{ number_format($stats['total_disbursed'] / 1000000, 1) }}M</p>
    </div>
    <div class="card rounded-xl p-4 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Total Outstanding</p>
      <p class="text-xl font-bold mt-1 text-yellow-500">TZS {{ number_format($stats['total_outstanding'] / 1000000, 1) }}M</p>
    </div>
    <div class="card rounded-xl p-4 border" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
      <p class="text-[11px] font-semibold" :class="darkMode?'text-primary-400':'text-primary-500'">Overdue</p>
      <p class="text-xl font-bold mt-1 text-red-500">{{ $stats['overdue_count'] }}</p>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <div class="flex flex-col sm:flex-row gap-3 mb-4">
      <input type="text" placeholder="Search loans..." class="form-input input-field text-xs py-2 flex-1"
             :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
      <select class="form-input input-field text-xs py-2 w-full sm:w-auto"
              :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
        <option>All Types</option>
        <option>Emergency</option>
        <option>Development</option>
        <option>Business</option>
        <option>Education</option>
        <option>Housing</option>
      </select>
    </div>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Loan Type</th>
            <th class="text-right">Principal</th>
            <th class="text-right">Rate</th>
            <th class="text-right">Balance</th>
            <th class="text-right">Installment</th>
            <th class="text-left">Next Due</th>
            <th class="text-left">Status</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($loans as $loan)
          <tr class="table-row">
            <td>
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-primary-800 flex items-center justify-center text-primary-300 text-xs font-bold">
                  {{ strtoupper(substr($loan->member->user->name ?? 'M', 0, 1)) }}
                </div>
                <div>
                  <p class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'">{{ $loan->member->user->name ?? 'Unknown' }}</p>
                  <p class="text-[10px] font-mono" :class="darkMode?'text-primary-500':'text-gray-400'">{{ $loan->loan_no }}</p>
                </div>
              </div>
            </td>
            <td><span class="badge badge-blue text-[10px]">{{ $loan->loan_type }}</span></td>
            <td class="text-right text-xs" :class="darkMode?'text-primary-300':'text-gray-700'">{{ number_format($loan->principal, 2) }}</td>
            <td class="text-right text-xs text-yellow-500">{{ $loan->interest_rate }}%</td>
            <td class="text-right text-xs font-bold text-red-500">{{ number_format($loan->balance, 2) }}</td>
            <td class="text-right text-xs" :class="darkMode?'text-primary-300':'text-gray-600'">{{ number_format($loan->installment_amount, 2) }}</td>
            <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'">{{ $loan->next_due_date ? $loan->next_due_date->format('M d, Y') : 'N/A' }}</td>
            <td>
              <span class="badge {{ $loan->status === 'active' ? 'badge-green' : ($loan->status === 'overdue' ? 'badge-red' : 'badge-yellow') }}">
                {{ ucfirst($loan->status) }}
              </span>
            </td>
            <td class="text-right">
              <div class="flex items-center justify-end gap-1">
                <button title="View Details" class="p-1.5 rounded-lg text-primary-500 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-[11px]">
                  <i class="fa-solid fa-eye"></i>
                </button>
                <button title="Make Repayment" class="p-1.5 rounded-lg text-green-500 hover:bg-green-100 dark:hover:bg-green-900/30 text-[11px]">
                  <i class="fa-solid fa-money-bill"></i>
                </button>
              </div>
            </td>
          </tr>
          @endforeach
          @if($loans->isEmpty())
          <tr>
            <td colspan="9" class="text-center py-10 text-gray-500 text-xs italic">No active loans found in the system.</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
    
    <div class="mt-4">
      {{ $loans->links() }}
    </div>
  </div>
</div>
@endsection
