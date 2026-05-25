<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Loan;
use App\Models\SavingsAccount;
use App\Models\Transaction;
use App\Models\AuditLog;
use App\Models\SystemSetting;
use App\Models\IpRestriction;
use App\Models\KycVerification;
use App\Models\AmlAlert;
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

    public function membersGroups()
    {
        return $this->renderPage('pages.members.groups', 'members-groups');
    }

    public function membersGuarantors()
    {
        return $this->renderPage('pages.members.guarantors', 'members-guarantors');
    }

    public function membersDocuments()
    {
        return $this->renderPage('pages.members.documents', 'members-documents');
    }

    public function membersBlacklisted()
    {
        return $this->renderPage('pages.members.blacklisted', 'members-blacklisted');
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

    public function loansApprovalWorkflow()
    {
        return $this->renderPage('pages.loans.approval_workflow', 'loan-approval-workflow');
    }

    public function loansGuarantorManagement()
    {
        return $this->renderPage('pages.loans.guarantor_mgmt', 'loan-guarantor-mgmt');
    }

    public function loansPenaltyCalculations()
    {
        return $this->renderPage('pages.loans.penalty_calc', 'loan-penalty-calc');
    }

    public function loansRestructuring()
    {
        return $this->renderPage('pages.loans.restructuring', 'loan-restructuring');
    }

    public function loansRefinancing()
    {
        return $this->renderPage('pages.loans.refinancing', 'loan-refinancing');
    }

    public function loansWriteOffs()
    {
        return $this->renderPage('pages.loans.write_offs', 'loan-write-offs');
    }

    public function loansProductsSetup()
    {
        return $this->renderPage('pages.loans.products_setup', 'loan-products-setup');
    }

    public function loansInterestConfiguration()
    {
        return $this->renderPage('pages.loans.interest_config', 'loan-interest-config');
    }

    public function loansCollateralManagement()
    {
        return $this->renderPage('pages.loans.collateral_mgmt', 'loan-collateral-mgmt');
    }

    public function investmentsActive()
    {
        return $this->renderPage('pages.investments.active', 'investments-active');
    }

    public function accountingLedger()
    {
        return $this->renderPage('pages.accounting.ledger', 'accounting-ledger');
    }

    public function accountingCashbook()
    {
        return $this->renderPage('pages.accounting.cashbook', 'accounting-cashbook');
    }

    public function accountingJournals()
    {
        return $this->renderPage('pages.accounting.journals', 'accounting-journals');
    }

    public function accountingTrialBalance()
    {
        return $this->renderPage('pages.accounting.trial_balance', 'accounting-trial-balance');
    }

    public function accountingProfitLoss()
    {
        return $this->renderPage('pages.accounting.profit_loss', 'accounting-profit-loss');
    }

    public function accountingBalanceSheet()
    {
        return $this->renderPage('pages.accounting.balance_sheet', 'accounting-balance-sheet');
    }

    public function accountingExpenses()
    {
        return $this->renderPage('pages.accounting.expenses', 'accounting-expenses');
    }

    public function accountingIncome()
    {
        return $this->renderPage('pages.accounting.income', 'accounting-income');
    }

    public function accountingBankRec()
    {
        return $this->renderPage('pages.accounting.bank_rec', 'accounting-bank-rec');
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

    public function settingsCurrency()
    {
        return $this->renderPage('pages.settings.currency', 'settings-currency');
    }

    public function settingsInterest()
    {
        return $this->renderPage('pages.settings.interest', 'settings-interest');
    }

    public function settingsPenalty()
    {
        return $this->renderPage('pages.settings.penalty', 'settings-penalty');
    }

    public function settingsFiscalYear()
    {
        return $this->renderPage('pages.settings.fiscal_year', 'settings-fiscal-year');
    }

    public function settingsBusinessProfile()
    {
        return $this->renderPage('pages.settings.business_profile', 'settings-business-profile');
    }

    public function settingsTax()
    {
        return $this->renderPage('pages.settings.tax', 'settings-tax');
    }

    public function settingsNumberGeneration()
    {
        return $this->renderPage('pages.settings.number_generation', 'settings-number-generation');
    }

    public function settingsBackup()
    {
        return $this->renderPage('pages.settings.backup', 'settings-backup');
    }

    public function settingsLanguage()
    {
        return $this->renderPage('pages.settings.language', 'settings-language');
    }

    public function notificationsSms()
    {
        return $this->renderPage('pages.notifications.sms', 'notif-sms');
    }

    public function adminUsers()
    {
        return $this->renderPage('pages.admin.users', 'admin-users');
    }

    public function adminRoles()
    {
        return $this->renderPage('pages.admin.roles', 'admin-roles');
    }

    public function adminPerformance()
    {
        return $this->renderPage('pages.admin.performance', 'admin-performance');
    }

    public function adminSessions()
    {
        return $this->renderPage('pages.admin.sessions', 'admin-sessions');
    }

    public function adminIpRestrictions()
    {
        return $this->renderPage('pages.admin.ip_restrictions', 'admin-ip-restrictions');
    }

    public function adminPasswordPolicies()
    {
        return $this->renderPage('pages.admin.password_policies', 'admin-password-policies');
    }

    public function adminEncryption()
    {
        return $this->renderPage('pages.admin.encryption', 'admin-encryption');
    }

    public function reportsCompliance()
    {
        return $this->renderPage('pages.reports.compliance', 'reports-compliance');
    }

    public function reportsBranchPerformance()
    {
        return $this->renderPage('pages.reports.branch_performance', 'reports-branch-performance');
    }

    public function reportsStaffPerformance()
    {
        return $this->renderPage('pages.reports.staff_performance', 'reports-staff-performance');
    }

    public function reportsDefaulterAnalysis()
    {
        return $this->renderPage('pages.reports.defaulter_analysis', 'reports-defaulter-analysis');
    }

    public function reportsCashflowAnalytics()
    {
        return $this->renderPage('pages.reports.cashflow_analytics', 'reports-cashflow-analytics');
    }

    public function reportsAiInsights()
    {
        return $this->renderPage('pages.reports.ai_insights', 'reports-ai-insights');
    }

    public function adminKyc()
    {
        return $this->renderPage('pages.admin.kyc', 'admin-kyc');
    }

    public function adminAml()
    {
        return $this->renderPage('pages.admin.aml', 'admin-aml');
    }

    public function adminFraud()
    {
        return $this->renderPage('pages.admin.fraud', 'admin-fraud');
    }

    public function adminRegulatory()
    {
        return $this->renderPage('pages.admin.regulatory', 'admin-regulatory');
    }

    public function adminFailedLogins()
    {
        return $this->renderPage('pages.admin.failed_logins', 'admin-failed-logins');
    }

    public function adminDeviceTracking()
    {
        return $this->renderPage('pages.admin.device_tracking', 'admin-device-tracking');
    }

    public function adminBrowserTracking()
    {
        return $this->renderPage('pages.admin.browser_tracking', 'admin-browser-tracking');
    }

    public function adminGeoLogs()
    {
        return $this->renderPage('pages.admin.geo_logs', 'admin-geo-logs');
    }

    public function adminActiveSessions()
    {
        return $this->renderPage('pages.admin.active_sessions', 'admin-active-sessions');
    }

    public function adminSuspiciousAlerts()
    {
        return $this->renderPage('pages.admin.suspicious_alerts', 'admin-suspicious-alerts');
    }

    public function adminReminders()
    {
        return $this->renderPage('pages.admin.reminders', 'admin-reminders');
    }

    public function adminDueAlerts()
    {
        return $this->renderPage('pages.admin.due_alerts', 'admin-due-alerts');
    }

    public function adminBulkSms()
    {
        return $this->renderPage('pages.admin.bulk_sms', 'admin-bulk-sms');
    }

    public function adminMarketing()
    {
        return $this->renderPage('pages.admin.marketing', 'admin-marketing');
    }

    public function adminReceipts()
    {
        return $this->renderPage('pages.admin.receipts', 'admin-receipts');
    }

    public function adminOtpSettings()
    {
        return $this->renderPage('pages.admin.otp_settings', 'admin-otp-settings');
    }

    public function adminAudit()
    {
        return $this->renderPage('pages.admin.audit', 'admin-audit');
    }

    public function adminCommunicationSettings()
    {
        return $this->renderPage('pages.admin.communication_settings', 'admin-comm-settings');
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
            $user = Auth::user();
            $user->update(['last_login_at' => now()]);
            $request->session()->regenerate();

            AuditLog::create([
                'user_id' => $user->id,
                'action' => 'Login',
                'module' => 'Authentication',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'success' => true
            ]);

            return response()->json([
                'success' => true,
                'user' => $user,
                'data' => $this->getAuthData($user)
            ]);
        }

        // Log failed attempt
        AuditLog::create([
            'user_id' => null,
            'action' => 'Failed Login Attempt',
            'module' => 'Authentication',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'success' => false
        ]);

        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function updateSettings(Request $request)
    {
        $settings = $request->all();
        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, 'general');
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update System Settings',
            'module' => 'Settings',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true]);
    }

    public function updateCommSettings(Request $request)
    {
        $group = $request->input('group');
        $settings = $request->input('settings');
        
        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, $group);
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Update " . strtoupper($group) . " Communication Settings",
            'module' => 'Communication',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true]);
    }

    public function updateSecurity(Request $request)
    {
        $settings = $request->all();
        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, 'security');
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Security Settings',
            'module' => 'Security',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true]);
    }

    public function updateBulkSms(Request $request)
    {
        $data = $request->validate([
            'group' => 'required|string',
            'message' => 'required|string',
        ]);

        // In a real app, this would trigger a job to send SMS
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Send Bulk SMS',
            'module' => 'Communication',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true]);
    }

    public function updateMarketing(Request $request)
    {
        // Implementation for marketing campaigns
        return response()->json(['success' => true]);
    }

    public function updateReceipts(Request $request)
    {
        $settings = $request->all();
        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, 'receipts');
        }
        return response()->json(['success' => true]);
    }

    public function updateOtpSettings(Request $request)
    {
        $settings = $request->all();
        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, 'otp');
        }
        return response()->json(['success' => true]);
    }

    public function updateReminders(Request $request)
    {
        $settings = $request->all();
        foreach ($settings as $key => $value) {
            SystemSetting::set($key, $value, 'reminders');
        }
        return response()->json(['success' => true]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Password Change',
            'module' => 'Security',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true]);
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'branch' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Create User: ' . $user->email,
            'module' => 'User Management',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function updateUser(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'branch' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update User: ' . $user->email,
            'module' => 'User Management',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function deleteUser(User $user)
    {
        $email = $user->email;
        $user->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete User: ' . $email,
            'module' => 'User Management',
            'ip_address' => request()->ip(),
            'success' => true
        ]);

        return response()->json(['success' => true]);
    }

    public function toggle2FA(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:authenticator,sms,email',
            'enabled' => 'required|boolean'
        ]);

        $user = Auth::user();
        
        if ($request->enabled) {
            $secret = bin2hex(random_bytes(10));
            $backupCodes = [];
            for ($i = 0; $i < 10; $i++) {
                $backupCodes[] = strtoupper(bin2hex(random_bytes(4)));
            }

            $user->update([
                'two_factor_enabled' => true,
                'two_factor_type' => $request->type,
                'two_factor_secret' => $secret,
                'two_factor_recovery_codes' => json_encode($backupCodes)
            ]);
            
            $action = "Enabled 2FA ({$request->type})";
            
            return response()->json([
                'success' => true,
                'user' => $user,
                'secret' => $secret,
                'backup_codes' => $backupCodes,
                'message' => $action . ' successfully'
            ]);
        } else {
            $user->update([
                'two_factor_enabled' => false,
                'two_factor_type' => null,
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null
            ]);
            $action = "Disabled 2FA";
        }

        AuditLog::create([
            'user_id' => $user->id,
            'action' => $action,
            'module' => 'Security',
            'ip_address' => $request->ip(),
            'success' => true
        ]);

        return response()->json([
            'success' => true,
            'user' => $user,
            'message' => $action . ' successfully'
        ]);
    }

    public function getUserLogs(User $user)
    {
        $logs = AuditLog::where('user_id', $user->id)
            ->latest()
            ->take(20)
            ->get();

        return response()->json([
            'success' => true,
            'logs' => $logs
        ]);
    }

    public function storeIpRestriction(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string',
            'ip_address' => 'required|ip',
        ]);

        $data['added_by'] = Auth::id();
        $restriction = IpRestriction::create($data);

        return response()->json(['success' => true, 'restriction' => $restriction]);
    }

    public function deleteIpRestriction(IpRestriction $restriction)
    {
        $restriction->delete();
        return response()->json(['success' => true]);
    }

    public function updateKycStatus(Request $request, KycVerification $kyc)
    {
        $data = $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'notes' => 'nullable|string',
        ]);

        $kyc->update([
            'status' => $data['status'],
            'notes' => $data['notes'],
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return response()->json(['success' => true, 'kyc' => $kyc]);
    }

    public function updateAmlStatus(Request $request, AmlAlert $alert)
    {
        $data = $request->validate([
            'status' => 'required|in:Investigating,Resolved,False Positive',
        ]);

        $alert->update(['status' => $data['status']]);

        return response()->json(['success' => true, 'alert' => $alert]);
    }

    public function terminateSession($id)
    {
        \DB::table('sessions')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function terminateAllSessions()
    {
        \DB::table('sessions')->where('user_id', '!=', Auth::id())->delete();
        return response()->json(['success' => true]);
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
            $data['systemSettings'] = SystemSetting::all()->groupBy('group');
            $data['auditLogs'] = AuditLog::with('user')->latest()->take(50)->get()->map(function($log) {
                $log->user_name = $log->user ? $log->user->name : 'System/Guest';
                $log->time = $log->created_at->diffForHumans();
                return $log;
            });
            $data['failedLogins'] = AuditLog::where('action', 'Failed Login Attempt')->latest()->take(50)->get()->map(function($log) {
                $log->time = $log->created_at->diffForHumans();
                return $log;
            });
            $data['ipRestrictions'] = IpRestriction::with('addedBy')->get();
            $data['kycVerifications'] = KycVerification::with(['member.user', 'verifiedBy'])->latest()->get();
            $data['amlAlerts'] = AmlAlert::with(['member.user', 'transaction'])->latest()->get();
            $data['activeSessions'] = \DB::table('sessions')->join('users', 'sessions.user_id', '=', 'users.id')->select('sessions.*', 'users.name', 'users.email')->get();
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
