@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Withdrawal Requests</h2>
    </div>

    <div class="card rounded-2xl p-5">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-left">Date</th>
                        <th class="text-left">Member</th>
                        <th class="text-left">Account</th>
                        <th class="text-right">Amount (TZS)</th>
                        <th class="text-left">Channel</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr class="table-row">
                        <td class="text-xs">{{ $request->created_at->format('M d, Y') }}</td>
                        <td class="text-xs font-semibold">{{ $request->member->user->name }}</td>
                        <td class="text-xs">{{ $request->savingsAccount->account_no }}</td>
                        <td class="text-right text-xs font-bold">{{ number_format($request->amount, 2) }}</td>
                        <td class="text-xs">{{ $request->channel }}</td>
                        <td class="text-right">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('withdrawals.approve', $request) }}" method="POST" onsubmit="return confirm('Approve this withdrawal?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-green-500/10 text-green-600 text-[10px] font-bold hover:bg-green-500/20">
                                        APPROVE
                                    </button>
                                </form>
                                <button @click="rejectId = {{ $request->id }}; showRejectModal = true" class="px-3 py-1.5 rounded-lg bg-red-500/10 text-red-600 text-[10px] font-bold hover:bg-red-500/20">
                                    REJECT
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($requests->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500 text-xs italic">No pending requests found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-show="showRejectModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-cloak>
        <div class="card rounded-2xl p-6 w-full max-w-md shadow-2xl" @click.away="showRejectModal = false">
            <h3 class="text-lg font-bold mb-4">Reject Withdrawal Request</h3>
            <form :action="`/withdrawals/${rejectId}/reject`" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-xs font-bold mb-1 block text-gray-400">Reason for Rejection *</label>
                    <textarea name="rejection_reason" required rows="3" class="w-full rounded-xl border p-2 text-sm" placeholder="Explain why the request is being rejected..."></textarea>
                </div>
                <div class="flex gap-2 pt-4">
                    <button type="button" @click="showRejectModal = false" class="flex-1 py-2 rounded-xl border font-bold text-xs">Cancel</button>
                    <button type="submit" class="flex-1 py-2 rounded-xl bg-red-600 text-white font-bold text-xs">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
