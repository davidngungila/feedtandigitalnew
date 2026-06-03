@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MEMBER PROFILE PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center gap-3">
    <button @click="navigate('members-active')" class="p-2 rounded-lg transition-colors"
            :class="darkMode?'text-primary-300 hover:bg-primary-900/30':'text-primary-700 hover:bg-primary-100'">
      <i class="fa-solid fa-arrow-left text-sm"></i>
    </button>
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Member Profile</h2>
  </div>

  <!-- Profile Header -->
  <div class="card rounded-2xl p-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
      <div class="w-20 h-20 rounded-2xl flex-shrink-0 overflow-hidden flex items-center justify-center">
        @if($member->passport_photo)
          <img src="{{ asset($member->passport_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
        @else
          <div class="w-full h-full bg-gradient-to-br from-primary-400 to-primary-700 flex items-center justify-center text-white text-3xl font-bold">
            {{ substr($member->user->name, 0, 1) }}
          </div>
        @endif
      </div>
      <div class="flex-1">
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-2">
          <h3 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $member->user->name }}</h3>
          <span class="badge {{ $member->status === 'Active' ? 'badge-green' : 'badge-red' }}">{{ $member->status }} Member</span>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
          <div><p :class="darkMode?'text-primary-400':'text-gray-500'">Member No.</p><p class="font-bold " :class="darkMode?'text-white':'text-primary-900'">{{ $member->member_no }}</p></div>
          <div><p :class="darkMode?'text-primary-400':'text-gray-500'">Phone</p><p class="font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $member->phone }}</p></div>
          <div><p :class="darkMode?'text-primary-400':'text-gray-500'">Region</p><p class="font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $member->region }}</p></div>
          <div><p :class="darkMode?'text-primary-400':'text-gray-500'">Joined</p><p class="font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $member->joined_at?->format('d F Y') }}</p></div>
        </div>
      </div>
      <div class="flex gap-2">
        <button @click="editMember(@json($member))" class="px-4 py-2 rounded-xl text-xs font-semibold border transition-colors"
                :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
          <i class="fa-solid fa-pen mr-1"></i> Edit
        </button>
        <button @click="showToast('Statement emailed to member!','success')" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
          <i class="fa-solid fa-envelope mr-1"></i> Send Statement
        </button>
      </div>
    </div>
  </div>

  <!-- Summary Cards -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
    <div class="card rounded-xl p-4"><p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Total Savings</p><p class="text-xl font-bold mt-1 text-green-500">TZS {{ number_format($member->total_savings, 0) }}</p></div>
    <div class="card rounded-xl p-4"><p class="text-[11px]" :class="darkMode?'text-primary-400':'text-primary-500'">Active Loans</p><p class="text-xl font-bold mt-1 text-yellow-500">TZS {{ number_format($member->total_loans, 0) }}</p></div>
    <div class="card rounded-xl p-4"><p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Investments</p><p class="text-xl font-bold mt-1 text-blue-500">TZS 0</p></div>
    <div class="card rounded-xl p-4"><p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Share Capital</p><p class="text-xl font-bold mt-1" :class="darkMode?'text-white':'text-primary-900'">TZS 0</p></div>
  </div>

  <!-- Transaction History -->
  <div class="card rounded-2xl p-5">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Transaction History</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead><tr>
          <th class="text-left">Date</th><th class="text-left">Type</th><th class="text-left">Product</th>
          <th class="text-left">Reference</th><th class="text-left">Channel</th>
          <th class="text-right">Amount</th><th class="text-right">Balance</th>
        </tr></thead>
        <tbody>
          @if($member->transactions->count() > 0)
            @foreach($member->transactions as $tx)
              <tr class="table-row">
                <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">{{ $tx->created_at?->format('d M Y') }}</td>
                <td><span class="badge text-[10px] {{ $tx->type === 'Deposit' ? 'badge-green' : ($tx->type === 'Withdrawal' ? 'badge-red' : 'badge-blue') }}">{{ $tx->type }}</span></td>
                <td class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'">{{ $tx->product ?? 'N/A' }}</td>
                <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">{{ $tx->reference ?? 'N/A' }}</td>
                <td class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'">{{ $tx->channel ?? 'N/A' }}</td>
                <td class="text-right text-xs font-bold {{ $tx->type === 'Deposit' ? 'text-green-500' : 'text-red-500' }}">{{ $tx->type === 'Deposit' ? '+' : '-' }}TZS {{ number_format($tx->amount ?? 0, 0) }}</td>
                <td class="text-right text-xs" :class="darkMode?'text-primary-300':'text-gray-700'">TZS {{ number_format($tx->balance ?? 0, 0) }}</td>
              </tr>
            @endforeach
          @else
            <tr class="table-row">
              <td colspan="7" class="text-center text-xs py-4" :class="darkMode?'text-primary-400':'text-gray-500'">No transactions yet</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection