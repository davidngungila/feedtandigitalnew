@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">My Loans</h2>
        <a href="{{ route('loans.apply') }}" class="px-4 py-2 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-500 transition-all">
            <i class="fa-solid fa-plus mr-1.5"></i> New Loan Application
        </a>
    </div>

    <div class="card rounded-2xl p-5">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">Loan No</th>
                        <th class="text-left">Type</th>
                        <th class="text-right">Principal</th>
                        <th class="text-right">Balance</th>
                        <th class="text-right">Installment</th>
                        <th class="text-left">Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr class="table-row">
                        <td class="text-xs font-mono font-bold">{{ $loan->loan_no }}</td>
                        <td><span class="badge badge-blue text-[10px]">{{ $loan->loan_type }}</span></td>
                        <td class="text-right text-xs">{{ number_format($loan->principal, 2) }}</td>
                        <td class="text-right text-xs font-bold text-red-500">{{ number_format($loan->balance, 2) }}</td>
                        <td class="text-right text-xs font-bold text-primary-600">{{ number_format($loan->installment_amount, 2) }}</td>
                        <td>
                            <span class="badge {{ $loan->status == 'active' ? 'badge-green' : ($loan->status == 'pending' ? 'badge-yellow' : 'badge-red') }} text-[10px]">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <button class="p-1.5 rounded-lg hover:bg-primary-50 text-primary-600 transition-colors">
                                <i class="fa-solid fa-file-lines"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-gray-500 text-xs italic">You have no active loans.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
