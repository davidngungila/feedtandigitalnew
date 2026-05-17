<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Loan;
use App\Models\SavingsAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('feedtan-digital', ['initialData' => $this->getInitialGuestData()]);
    }

    public function dashboard()
    {
        return $this->renderPage('pages.dashboard', 'dashboard');
    }

    public function membersActive()
    {
        return $this->renderPage('pages.members.active', 'members-active');
    }

    public function membersRegister()
    {
        return $this->renderPage('pages.members.register', 'member-register');
    }

    public function membersProfile()
    {
        return $this->renderPage('pages.members.profile', 'member-profile');
    }

    public function profile()
    {
        return $this->renderPage('pages.profile', 'profile');
    }

    public function membersStatements()
    {
        return $this->renderPage('pages.members.statements', 'members-statements');
    }

    public function savingsPlans()
    {
        return $this->renderPage('pages.savings.plans', 'savings-plans');
    }

    public function savingsDeposit()
    {
        return $this->renderPage('pages.savings.deposit', 'savings-deposit');
    }

    public function savingsAccounts()
    {
        return $this->renderPage('pages.savings.accounts', 'savings-accounts');
    }

    public function loansApply()
    {
        return $this->renderPage('pages.loans.apply', 'loan-apply');
    }

    public function loansActive()
    {
        return $this->renderPage('pages.loans.active', 'loan-active');
    }

    public function loansRepayments()
    {
        return $this->renderPage('pages.loans.repayments', 'loan-repayments');
    }

    public function investmentsActive()
    {
        return $this->renderPage('pages.investments.active', 'investments-active');
    }

    public function accountingLedger()
    {
        return $this->renderPage('pages.accounting.ledger', 'accounting-ledger');
    }

    public function reportsFinancial()
    {
        return $this->renderPage('pages.reports.financial', 'reports-financial');
    }

    public function reportsMembers()
    {
        return $this->renderPage('pages.reports.members', 'reports-members');
    }

    public function reportsSavings()
    {
        return $this->renderPage('pages.reports.savings', 'reports-savings');
    }

    public function reportsLoans()
    {
        return $this->renderPage('pages.reports.loans', 'reports-loans');
    }

    public function reportsAudit()
    {
        return $this->renderPage('pages.reports.audit', 'reports-audit');
    }

    public function reportsRisk()
    {
        return $this->renderPage('pages.reports.risk_performance', 'reports-risk');
    }

    public function paymentsMpesa()
    {
        return $this->renderPage('pages.payments.mpesa', 'payments-mpesa');
    }

    public function paymentsMobile()
    {
        return $this->renderPage('pages.payments.mobile', 'payments-mobile');
    }

    public function communication()
    {
        return $this->renderPage('pages.communication', 'communication');
    }

    public function formulaEngine()
    {
        return $this->renderPage('pages.formula_engine', 'formula-engine');
    }

    public function security()
    {
        return $this->renderPage('pages.security', 'security');
    }

    public function settings()
    {
        return $this->renderPage('pages.settings', 'settings');
    }

    public function notificationsSms()
    {
        return $this->renderPage('pages.notifications.sms', 'notif-sms');
    }

    public function adminUsers()
    {
        return $this->renderPage('pages.admin.users', 'admin-users');
    }

    public function adminAudit()
    {
        return $this->renderPage('pages.admin.audit', 'admin-audit');
    }

    public function withdrawalsRequests()
    {
        return $this->renderPage('pages.withdrawals.requests', 'withdrawal-requests');
    }

    private function renderPage($view, $activePage)
    {
        $user = Auth::user();
        $initialData = $this->getAuthData($user);
        $initialData['activePage'] = $activePage;

        return view($view, [
            'initialData' => $initialData
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'user' => Auth::user(),
                'data' => $this->getAuthData(Auth::user())
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['success' => true]);
    }

    private function getInitialGuestData()
    {
        return [
            'loggedIn' => false,
            'currentUser' => null,
            'members' => [],
            'recentTransactions' => [],
            'activeLoans' => [],
            'savingsAccounts' => [],
        ];
    }

    private function getAuthData($user)
    {
        $data = [
            'loggedIn' => true,
            'currentUser' => $user,
        ];

        if ($user->isAdmin() || $user->isManager() || $user->isTeller() || $user->isAuditor()) {
            // Admin/Staff view - see everything
            $data['members'] = Member::with(['user', 'savingsAccounts', 'loans'])->get()->map(function($m) {
                $m->total_savings = $m->savingsAccounts->sum('balance');
                $m->total_loans = $m->loans->where('status', 'active')->sum('balance');
                return $m;
            });
            $data['recentTransactions'] = Transaction::with(['member.user', 'savingsAccount', 'loan'])->latest()->take(15)->get();
            $data['activeLoans'] = Loan::with('member.user')->where('status', 'active')->get();
            $data['pendingLoans'] = Loan::with('member.user')->where('status', 'pending')->get();
            $data['savingsAccounts'] = SavingsAccount::with('member.user')->get();
            $data['systemUsers'] = User::all();
        } else {
            // Member view - only their own data
            $member = Member::with(['user', 'savingsAccounts', 'loans', 'transactions'])->where('user_id', $user->id)->first();
            if ($member) {
                $data['memberProfile'] = $member;
                $data['memberAccounts'] = $member->savingsAccounts;
                $data['memberLoans'] = $member->loans;
                $data['memberTransactions'] = $member->transactions()->latest()->take(10)->get();
                
                // For compatibility with the frontend variables
                $data['recentTransactions'] = $data['memberTransactions'];
                $data['activeLoans'] = $member->loans()->where('status', 'active')->get();
                $data['savingsAccounts'] = SavingsAccount::with('member.user')->where('member_id', $member->id)->get();
            }
        }

        return $data;
    }
}
