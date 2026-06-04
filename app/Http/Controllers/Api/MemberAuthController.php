<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\SavingsAccount;
use App\Models\Loan;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\KycVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MemberAuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $otp = rand(100000, 999999);
        
        session()->put('otp_' . $request->phone, $otp);
        session()->put('otp_expires_' . $request->phone, now()->addMinutes(10));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'data' => [
                'otp' => $otp, // In production, use SMS gateway
                'expires_at' => now()->addMinutes(10)->toISOString()
            ]
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'otp' => 'required|digits:6'
        ]);

        $storedOtp = session()->get('otp_' . $request->phone);
        $otpExpires = session()->get('otp_expires_' . $request->phone);

        if (!$storedOtp || now()->isAfter($otpExpires)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired or invalid'
            ], 400);
        }

        if ($request->otp != $storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 400);
        }

        session()->forget('otp_' . $request->phone);
        session()->forget('otp_expires_' . $request->phone);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully'
        ]);
    }

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
            ], 403);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is inactive',
                'data' => ['needs_registration' => false]
            ], 403);
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

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();
        
        $savingsAccounts = SavingsAccount::where('member_id', $member->id)->get();
        $totalSavings = $savingsAccounts->sum('balance');
        
        $activeLoans = Loan::where('member_id', $member->id)->where('status', 'active')->get();
        $totalActiveLoans = $activeLoans->sum('balance');
        $loanDue = $activeLoans->sum('payment_amount') ?? 0;
        
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

    public function getProfile(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Profile retrieved successfully',
            'data' => [
                'member' => $member,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone
                ]
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'nida' => 'nullable|string',
            'gender' => 'nullable|in:Male,Female,Other',
            'dob' => 'nullable|date',
            'marital_status' => 'nullable|string',
            'occupation' => 'nullable|string',
            'employer' => 'nullable|string',
            'region' => 'nullable|string',
            'district' => 'nullable|string',
            'ward' => 'nullable|string',
            'street' => 'nullable|string',
            'po_box' => 'nullable|string',
            'next_of_kin_name' => 'nullable|string',
            'next_of_kin_relationship' => 'nullable|string',
            'next_of_kin_phone' => 'nullable|string',
        ]);

        $user->update([
            'name' => $validated['name'] ?? $user->name,
            'email' => $validated['email'] ?? $user->email,
            'phone' => $validated['phone'] ?? $user->phone,
        ]);

        $member->update([
            'phone' => $validated['phone'] ?? $member->phone,
            'nida' => $validated['nida'] ?? $member->nida,
            'gender' => $validated['gender'] ?? $member->gender,
            'dob' => $validated['dob'] ?? $member->dob,
            'marital_status' => $validated['marital_status'] ?? $member->marital_status,
            'occupation' => $validated['occupation'] ?? $member->occupation,
            'employer' => $validated['employer'] ?? $member->employer,
            'region' => $validated['region'] ?? $member->region,
            'district' => $validated['district'] ?? $member->district,
            'ward' => $validated['ward'] ?? $member->ward,
            'street' => $validated['street'] ?? $member->street,
            'po_box' => $validated['po_box'] ?? $member->po_box,
            'next_of_kin_name' => $validated['next_of_kin_name'] ?? $member->next_of_kin_name,
            'next_of_kin_relationship' => $validated['next_of_kin_relationship'] ?? $member->next_of_kin_relationship,
            'next_of_kin_phone' => $validated['next_of_kin_phone'] ?? $member->next_of_kin_phone,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => ['member' => $member]
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'passport_photo' => 'nullable|image|max:2048',
            'nida_card' => 'nullable|image|max:2048',
        ]);

        $data = [];
        if ($request->hasFile('passport_photo')) {
            $path = $request->file('passport_photo')->store('members/photos', 'public');
            $data['passport_photo'] = $path;
        }
        if ($request->hasFile('nida_card')) {
            $path = $request->file('nida_card')->store('members/documents', 'public');
            $data['nida_card'] = $path;
        }

        $member->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Photo(s) uploaded successfully',
            'data' => [
                'passport_photo' => $member->passport_photo ? asset($member->passport_photo) : null,
                'nida_card' => $member->nida_card ? asset($member->nida_card) : null
            ]
        ]);
    }

    public function changePin(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_pin' => 'required',
            'new_pin' => 'required|digits_between:4,10|different:current_pin'
        ]);

        if (!Hash::check($request->current_pin, $user->pin)) {
            return response()->json([
                'success' => false,
                'message' => 'Current PIN is incorrect'
            ], 400);
        }

        $user->update(['pin' => Hash::make($request->new_pin)]);

        return response()->json([
            'success' => true,
            'message' => 'PIN changed successfully'
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|different:current_password'
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 400);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully'
        ]);
    }

    public function getSavingsAccounts(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $accounts = SavingsAccount::where('member_id', $member->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Savings accounts retrieved successfully',
            'data' => $accounts
        ]);
    }

    public function getLoans(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $loans = Loan::where('member_id', $member->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Loans retrieved successfully',
            'data' => $loans
        ]);
    }

    public function getInvestments(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $investments = Investment::where('member_id', $member->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Investments retrieved successfully',
            'data' => $investments
        ]);
    }

    public function getTransactions(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $perPage = $request->per_page ?? 20;
        $transactions = $member->transactions()
            ->orderBy('date', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Transactions retrieved successfully',
            'data' => $transactions
        ]);
    }

    public function getStatements(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
        ]);

        $query = $member->transactions();

        if ($request->from_date) {
            $query->where('date', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $query->where('date', '<=', $request->to_date);
        }

        $statements = $query->orderBy('date', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Statements retrieved successfully',
            'data' => $statements
        ]);
    }

    public function submitKyc(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'type' => 'required|in:national_id,passport,driver_license',
            'document_number' => 'required|string',
            'document_image' => 'required|image|max:5120',
            'selfie' => 'nullable|image|max:5120',
        ]);

        $documentPath = $request->file('document_image')->store('kyc/documents', 'public');
        $selfiePath = $request->hasFile('selfie') ? $request->file('selfie')->store('kyc/selfies', 'public') : null;

        $kyc = KycVerification::create([
            'member_id' => $member->id,
            'user_id' => $user->id,
            'type' => $validated['type'],
            'document_number' => $validated['document_number'],
            'document_path' => $documentPath,
            'selfie_path' => $selfiePath,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'KYC submitted successfully for verification',
            'data' => ['kyc' => $kyc]
        ], 201);
    }

    public function getKycStatus(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        $kyc = KycVerification::where('member_id', $member->id)->latest()->first();

        return response()->json([
            'success' => true,
            'message' => 'KYC status retrieved successfully',
            'data' => ['kyc' => $kyc]
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
