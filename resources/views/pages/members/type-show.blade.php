@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MEMBER TYPE DETAILS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center gap-3">
    <button onclick="window.location.href='{{ route('members.types') }}'" class="p-2 rounded-lg transition-colors"
            :class="darkMode?'text-primary-300 hover:bg-primary-900/30':'text-primary-700 hover:bg-primary-100'">
      <i class="fa-solid fa-arrow-left text-sm"></i>
    </button>
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $memberType->name }}</h2>
  </div>

  <!-- Type Info -->
  <div class="card rounded-2xl p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Description</p>
        <p class="font-semibold text-sm" :class="darkMode?'text-white':'text-primary-900'">{{ $memberType->description ?? 'No description' }}</p>
      </div>
      <div>
        <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Status</p>
        <span class="badge {{ $memberType->status === 'Active' ? 'badge-green' : 'badge-red' }}">{{ $memberType->status }}</span>
      </div>
      <div>
        <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">Total Members</p>
        <p class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ $memberType->members->count() }}</p>
      </div>
    </div>
  </div>

  <!-- Members List -->
  <div class="card rounded-2xl p-5">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Members in this Type</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">Member No</th>
            <th class="text-left">Region</th>
            <th class="text-left">Savings</th>
            <th class="text-left">Loans</th>
            <th class="text-left">Status</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          @if($memberType->members->count() > 0)
            @foreach($memberType->members as $m)
              <tr class="table-row">
                <td>
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 overflow-hidden">
                      @if($m->passport_photo)
                        <img src="{{ asset($m->passport_photo) }}" class="w-full h-full object-cover" alt="">
                      @else
                        {{ $m->user ? substr($m->user->name, 0, 1) : '?' }}
                      @endif
                    </div>
                    <div>
                      <p class="font-semibold text-xs" :class="darkMode?'text-white':'text-primary-900'">{{ $m->user?->name ?? 'Unknown' }}</p>
                      <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'">{{ $m->phone }}</p>
                    </div>
                  </div>
                </td>
                <td class="text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'">{{ $m->member_no }}</td>
                <td class="text-xs" :class="darkMode?'text-primary-300':'text-gray-600'">{{ $m->region }}</td>
                <td class="text-xs text-green-500 font-semibold">TZS {{ number_format($m->total_savings, 0) }}</td>
                <td class="text-xs" :class="$m->total_loans > 0 ? 'text-yellow-500 font-semibold' : (isset($darkMode) ? 'text-primary-400' : 'text-gray-400')">
                  {{ $m->total_loans > 0 ? 'TZS ' . number_format($m->total_loans, 0) : 'None' }}
                </td>
                <td><span class="badge {{ $m->status === 'Active' ? 'badge-green' : 'badge-red' }}">{{ $m->status }}</span></td>
                <td>
                  <div class="flex items-center gap-1">
                    <a href="{{ route('members.profile', $m->id) }}" class="p-1.5 rounded-lg text-primary-500 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-[11px] transition-colors" title="View">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          @else
            <tr class="table-row">
              <td colspan="7" class="text-center text-xs py-4" :class="darkMode?'text-primary-400':'text-gray-500'">No members in this type yet</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection