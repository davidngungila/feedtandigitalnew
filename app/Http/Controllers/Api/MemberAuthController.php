<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\SavingsAccount;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberAuthController extends Controller
{
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found in system, please register first',
                'data' => ['needs_registration' => true]
            ]);
        }

        if ($user->role !== 'member') {
            return response()->json([
                'success' => false,
                'message' => 'This email is not registered as a member',
                'data' => ['needs_registration' => false]
            ]);
        }

        $member = Member::where('user_id', $user->id)->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member profile not found',
                'data' => ['needs_registration' => false]
            ]);
        }

        if ($member->mobile_lock) {
            return response()->json([
                'success' => false,
                'message' => 'Your account has been locked. Please contact support',
                'data' => ['needs_registration' => false]
            ]);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is inactive',
                'data' => ['needs_registration' => false]
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Email found',
            'data' => [
                'needs_registration' => false,
                'pin_is_set' => $user->pin_is_set,
                'member' => [
                    'member_no' => $member->member_no,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $member->phone,
                    'region' => $member->region,
                    'branch' => $member->branch,
                    'membership_type' => $member->membership_type,
                    'status' => $member->status,
                    'joined_at' => $member->joined_at,
                    'passport_photo' => $member->passport_photo ? asset($member->passport_photo) : null,
                ]
            ]
        ]);
    }

    public function loginFirstTime(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'pin' => 'required|digits_between:4,10',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role !== 'member') {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $member = Member::where('user_id', $user->id)->first();

        if ($member->mobile_lock || !$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied'
            ], 403);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password'
            ], 401);
        }

        $user->update([
            'pin' => Hash::make($request->pin),
            'pin_is_set' => true
        ]);

        $token = $user->createToken('mobile-app-token')->plainTextToken;

        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'PIN set and logged in successfully',
            'data' => [
                'token' => $token,
                'member' => [
                    'member_no' => $member->member_no,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $member->phone,
                    'region' => $member->region,
                    'branch' => $member->branch,
                    'membership_type' => $member->membership_type,
                    'status' => $member->status,
                    'joined_at' => $member->joined_at,
                    'passport_photo' => $member->passport_photo ? asset($member->passport_photo) : null,
                ]
            ]
        ]);
    }

    public function loginWithPin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pin' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role !== 'member' || !$user->pin_is_set) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $member = Member::where('user_id', $user->id)->first();

        if ($member->mobile_lock || !$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied'
            ], 403);
        }

        if (!Hash::check($request->pin, $user->pin)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid PIN'
            ], 401);
        }

        $token = $user->createToken('mobile-app-token')->plainTextToken;

        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully with PIN',
            'data' => [
                'token' => $token,
                'member' => [
                    'member_no' => $member->member_no,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $member->phone,
                    'region' => $member->region,
                    'branch' => $member->branch,
                    'membership_type' => $member->membership_type,
                    'status' => $member->status,
                    'joined_at' => $member->joined_at,
                    'passport_photo' => $member->passport_photo ? asset($member->passport_photo) : null,
                ]
            ]
        ]);
    }

    public function registerMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'nida' => 'nullable|string',
            'gender' => 'required|in:Male,Female,Other',
            'dob' => 'nullable|date',
            'marital_status' => 'nullable|string',
            'occupation' => 'nullable|string',
            'employer' => 'nullable|string',
            'region' => 'required|string',
            'district' => 'nullable|string',
            'ward' => 'nullable|string',
            'street' => 'nullable|string',
            'po_box' => 'nullable|string',
            'branch' => 'nullable|string',
            'membership_type' => 'nullable|string',
            'next_of_kin_name' => 'nullable|string',
            'next_of_kin_relationship' => 'nullable|string',
            'next_of_kin_phone' => 'nullable|string',
            'pin' => 'required|digits_between:4,10',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pin' => Hash::make($request->pin),
            'pin_is_set' => true,
            'role' => 'member',
            'phone' => $request->phone,
            'is_active' => true
        ]);

        $memberNo = 'M-' . date('Y') . '-' . str_pad(Member::max('id') + 1, 6, '0', STR_PAD_LEFT);

        $member = Member::create([
            'user_id' => $user->id,
            'member_no' => $memberNo,
            'nida' => $request->nida,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'marital_status' => $request->marital_status,
            'occupation' => $request->occupation,
            'employer' => $request->employer,
            'region' => $request->region,
            'district' => $request->district,
            'ward' => $request->ward,
            'street' => $request->street,
            'po_box' => $request->po_box,
            'branch' => $request->branch ?? 'Main',
            'membership_type' => $request->membership_type ?? 'Regular',
            'status' => 'Active',
            'joined_at' => now(),
            'mobile_lock' => false,
            'next_of_kin_name' => $request->next_of_kin_name,
            'next_of_kin_relationship' => $request->next_of_kin_relationship,
            'next_of_kin_phone' => $request->next_of_kin_phone,
        ]);

        $token = $user->createToken('mobile-app-token')->plainTextToken;

        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Member registered successfully',
            'data' => [
                'token' => $token,
                'member' => [
                    'member_no' => $member->member_no,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $member->phone,
                    'region' => $member->region,
                    'branch' => $member->branch,
                    'membership_type' => $member->membership_type,
                    'status' => $member->status,
                    'joined_at' => $member->joined_at,
                ]
            ]
        ], 201);
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();
        
        // Get savings accounts
        $savingsAccounts = SavingsAccount::where('member_id', $member->id)->get();
        $totalSavings = $savingsAccounts->sum('balance');
        
        // Get loans
        $activeLoans = Loan::where('member_id', $member->id)->where('status', 'active')->get();
        $totalActiveLoans = $activeLoans->sum('balance');
        $loanDue = $activeLoans->sum('payment_amount') ?? 0;
        
        // Recent transactions
        $recentTransactions = $member->transactions()->latest()->take(10)->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Dashboard data retrieved successfully',
            'data' => [
                'member' => [
                    'member_no' => $member->member_no,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $member->phone,
                    'region' => $member->region,
                    'branch' => $member->branch,
                    'membership_type' => $member->membership_type,
                    'status' => $member->status,
                    'joined_at' => $member->joined_at,
                    'passport_photo' => $member->passport_photo ? asset($member->passport_photo) : null,
                ],
                'balances' => [
                    'total_savings' => $totalSavings,
                    'active_loans' => $totalActiveLoans,
                    'loan_due' => $loanDue,
                    'shares' => 0,
                    'welfare' => 0,
                    'investments' => 0,
                ],
                'recent_transactions' => $recentTransactions
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
