<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use App\Models\KycVerification;
use App\Models\AuditLog;
use App\Models\MemberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    private function renderPage($view, $activePage, $additionalData = [])
    {
        $user = Auth::user();
        $initialData = $this->getAuthData($user);
        $initialData['activePage'] = $activePage;

        return view($view, array_merge([
            'initialData' => $initialData
        ], $additionalData));
    }

    private function getAuthData($user)
    {
        $data = [
            'loggedIn' => true,
            'currentUser' => $user,
            'isLoading' => false,
        ];

        $data['members'] = Member::with(['user', 'savingsAccounts', 'loans'])->get()->map(function($m) {
            $m->total_savings = $m->savingsAccounts->sum('balance');
            $m->total_loans = $m->loans->where('status', 'active')->sum('balance');
            return $m;
        });
        
        $data['memberTypes'] = MemberType::all();
        $data['documents'] = KycVerification::with(['member.user'])->latest()->get();
        $data['blacklisted'] = Member::with('user')->where('status', 'Suspended')->latest()->get();
        
        return $data;
    }

    public function active()
    {
        return $this->renderPage('pages.members.active', 'members-active');
    }

    public function register()
    {
        return $this->renderPage('pages.members.register', 'member-register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'nida' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:10',
            'dob' => 'nullable|date',
            'marital_status' => 'nullable|string|max:20',
            'occupation' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'region' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'po_box' => 'nullable|string|max:20',
            'membership_type' => 'required|string|max:50',
            'branch' => 'nullable|string|max:255',
            'next_of_kin_name' => 'nullable|string|max:255',
            'next_of_kin_relationship' => 'nullable|string|max:50',
            'next_of_kin_phone' => 'nullable|string|max:20',
            'passport_photo' => 'nullable|image|max:2048',
            'nida_card' => 'nullable|image|max:2048',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? 'member_' . time() . '@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $memberData = [
            'user_id' => $user->id,
            'member_no' => 'MBR-' . date('Y') . '-' . str_pad(Member::max('id') + 1, 6, '0', STR_PAD_LEFT),
            'nida' => $validated['nida'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'marital_status' => $validated['marital_status'],
            'occupation' => $validated['occupation'],
            'employer' => $validated['employer'],
            'region' => $validated['region'],
            'district' => $validated['district'],
            'ward' => $validated['ward'],
            'street' => $validated['street'],
            'po_box' => $validated['po_box'],
            'membership_type' => $validated['membership_type'],
            'branch' => $validated['branch'],
            'next_of_kin_name' => $validated['next_of_kin_name'],
            'next_of_kin_relationship' => $validated['next_of_kin_relationship'],
            'next_of_kin_phone' => $validated['next_of_kin_phone'],
            'status' => 'Active',
            'joined_at' => now(),
        ];

        if ($request->hasFile('passport_photo')) {
            $memberData['passport_photo'] = 'storage/' . $request->file('passport_photo')->store('member-photos', 'public');
        }
        if ($request->hasFile('nida_card')) {
            $memberData['nida_card'] = 'storage/' . $request->file('nida_card')->store('member-docs', 'public');
        }

        $member = Member::create($memberData);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Member Registered: ' . $user->name,
            'module' => 'Members',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true, 'member' => $member->load(['user', 'savingsAccounts', 'loans'])]);
    }

    public function profile(Member $member)
    {
        $member->load(['user', 'savingsAccounts', 'loans', 'transactions']);
        $member->total_savings = $member->savingsAccounts->sum('balance');
        $member->total_loans = $member->loans->where('status', 'active')->sum('balance');
        return $this->renderPage('pages.members.profile', 'member-profile', ['member' => $member]);
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $member->user_id,
            'nida' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:10',
            'dob' => 'nullable|date',
            'marital_status' => 'nullable|string|max:20',
            'occupation' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'po_box' => 'nullable|string|max:20',
            'membership_type' => 'nullable|string|max:50',
            'branch' => 'nullable|string|max:255',
            'next_of_kin_name' => 'nullable|string|max:255',
            'next_of_kin_relationship' => 'nullable|string|max:50',
            'next_of_kin_phone' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:20',
            'passport_photo' => 'nullable|image|max:2048',
            'nida_card' => 'nullable|image|max:2048',
        ]);

        $memberData = collect($validated)->only([
            'nida', 'phone', 'gender', 'dob', 'marital_status', 'occupation', 'employer',
            'region', 'district', 'ward', 'street', 'po_box', 'membership_type', 'branch',
            'next_of_kin_name', 'next_of_kin_relationship', 'next_of_kin_phone', 'status'
        ])->toArray();

        if ($request->hasFile('passport_photo')) {
            if ($member->passport_photo && file_exists(public_path($member->passport_photo))) {
                unlink(public_path($member->passport_photo));
            }
            $memberData['passport_photo'] = 'storage/' . $request->file('passport_photo')->store('member-photos', 'public');
        }
        if ($request->hasFile('nida_card')) {
            if ($member->nida_card && file_exists(public_path($member->nida_card))) {
                unlink(public_path($member->nida_card));
            }
            $memberData['nida_card'] = 'storage/' . $request->file('nida_card')->store('member-docs', 'public');
        }

        $member->update($memberData);

        if ($request->has('name') || $request->has('email')) {
            $member->user->update([
                'name' => $request->name ?? $member->user->name,
                'email' => $request->email ?? $member->user->email,
            ]);
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Member Updated: ' . $member->user->name,
            'module' => 'Members',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true, 'member' => $member->load(['user', 'savingsAccounts', 'loans'])]);
    }

    public function destroy(Request $request, Member $member)
    {
        $email = $member->user->email;
        $name = $member->user->name;
        $reason = $request->input('reason', 'No reason provided');
        
        $member->user->delete();
        $member->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Member Deleted: ' . $name . ' (Reason: ' . $reason . ')',
            'module' => 'Members',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Member deleted successfully!');
    }

    public function documents()
    {
        $documents = KycVerification::with(['member.user'])->latest()->get();
        return $this->renderPage('pages.members.documents', 'members-documents', compact('documents'));
    }

    public function blacklisted()
    {
        $blacklisted = Member::with('user')->where('status', 'Suspended')->latest()->get();
        return $this->renderPage('pages.members.blacklisted', 'members-blacklisted', compact('blacklisted'));
    }

    public function types()
    {
        $types = MemberType::all();
        $types = $types->map(function($type) {
            $type->count = Member::where('membership_type', $type->name)->count();
            return $type;
        });
        return $this->renderPage('pages.members.types', 'member-types', compact('types'));
    }

    public function showType(MemberType $memberType)
    {
        $memberType->load(['members' => function($query) {
            $query->with(['user', 'savingsAccounts', 'loans']);
        }]);
        $memberType->members = $memberType->members->map(function($m) {
            $m->total_savings = $m->savingsAccounts->sum('balance');
            $m->total_loans = $m->loans->where('status', 'active')->sum('balance');
            return $m;
        });
        return $this->renderPage('pages.members.type-show', 'member-types', compact('memberType'));
    }
    
    public function storeType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:member_types',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Active,Inactive',
        ]);
        
        $type = MemberType::create($validated);
        
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Member Type Created: ' . $type->name,
            'module' => 'Members',
            'ip_address' => $request->ip(),
            'success' => true
        ]);
        
        return response()->json(['success' => true, 'type' => $type]);
    }
    
    public function updateType(Request $request, MemberType $memberType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:member_types,name,' . $memberType->id,
            'description' => 'nullable|string',
            'status' => 'nullable|in:Active,Inactive',
        ]);
        
        $memberType->update($validated);
        
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Member Type Updated: ' . $memberType->name,
            'module' => 'Members',
            'ip_address' => $request->ip(),
            'success' => true
        ]);
        
        return response()->json(['success' => true, 'type' => $memberType]);
    }
    
    public function destroyType(Request $request, MemberType $memberType)
    {
        $name = $memberType->name;
        $memberType->delete();
        
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Member Type Deleted: ' . $name,
            'module' => 'Members',
            'ip_address' => $request->ip(),
            'success' => true
        ]);
        
        return response()->json(['success' => true]);
    }

    public function statements()
    {
        $members = Member::with('user')->latest()->get();
        return $this->renderPage('pages.members.statements', 'members-statements', compact('members'));
    }
}
