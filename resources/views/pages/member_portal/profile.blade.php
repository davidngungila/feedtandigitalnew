@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold" :class="darkMode?'text-white':'text-primary-900'">Personal Profile</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="card rounded-2xl p-6 border lg:col-span-1" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <div class="flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-primary-600 flex items-center justify-center text-white text-3xl font-bold mb-4">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h3 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">{{ Auth::user()->name }}</h3>
                <p class="text-xs text-gray-500 mb-4">{{ $member->member_no }}</p>
                <span class="badge badge-green px-4 py-1">{{ $member->status }} Member</span>
            </div>
            
            <div class="mt-8 space-y-4">
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500">Joined Date</span>
                    <span class="font-bold">{{ $member->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500">Email</span>
                    <span class="font-bold">{{ Auth::user()->email }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500">Phone</span>
                    <span class="font-bold">{{ $member->phone ?? 'Not set' }}</span>
                </div>
            </div>
        </div>

        <!-- Details Form -->
        <div class="card rounded-2xl p-6 border lg:col-span-2" :class="darkMode?'border-[#1a3328]':'border-primary-100'">
            <h3 class="font-bold text-sm mb-6" :class="darkMode?'text-white':'text-primary-900'">Additional Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Occupation</p>
                    <p class="text-sm font-semibold">{{ $member->occupation ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Employer</p>
                    <p class="text-sm font-semibold">{{ $member->employer ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Region</p>
                    <p class="text-sm font-semibold">{{ $member->region ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">District</p>
                    <p class="text-sm font-semibold">{{ $member->district ?? 'N/A' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Residential Address</p>
                    <p class="text-sm font-semibold">{{ $member->ward }}, {{ $member->street }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
