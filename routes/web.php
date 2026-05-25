<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/login', [DashboardController::class, 'showLogin'])->name('login');
Route::post('/login', [DashboardController::class, 'login'])->name('do-login');
Route::post('/logout', [DashboardController::class, 'logout'])->name('do-logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/members/active', [DashboardController::class, 'membersActive'])->name('members.active');
    Route::get('/members/register', [DashboardController::class, 'membersRegister'])->name('members.register');
    Route::get('/members/profile', [DashboardController::class, 'membersProfile'])->name('members.profile');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/members/statements', [DashboardController::class, 'membersStatements'])->name('members.statements');
    Route::get('/members/groups', [DashboardController::class, 'membersGroups'])->name('members.groups');
    Route::get('/members/guarantors', [DashboardController::class, 'membersGuarantors'])->name('members.guarantors');
    Route::get('/members/documents', [DashboardController::class, 'membersDocuments'])->name('members.documents');
    Route::get('/members/blacklisted', [DashboardController::class, 'membersBlacklisted'])->name('members.blacklisted');
    
    Route::get('/savings/plans', [DashboardController::class, 'savingsPlans'])->name('savings.plans');
    Route::get('/savings/deposit', [DashboardController::class, 'savingsDeposit'])->name('savings.deposit');
    Route::get('/savings/accounts', [DashboardController::class, 'savingsAccounts'])->name('savings.accounts');
    
    Route::get('/loans/apply', [DashboardController::class, 'loansApply'])->name('loans.apply');
    Route::get('/loans/active', [DashboardController::class, 'loansActive'])->name('loans.active');
    Route::get('/loans/repayments', [DashboardController::class, 'loansRepayments'])->name('loans.repayments');
    Route::get('/loans/approval-workflow', [DashboardController::class, 'loansApprovalWorkflow'])->name('loans.approval-workflow');
    Route::get('/loans/guarantor-mgmt', [DashboardController::class, 'loansGuarantorManagement'])->name('loans.guarantor-mgmt');
    Route::get('/loans/penalty-calc', [DashboardController::class, 'loansPenaltyCalculations'])->name('loans.penalty-calc');
    Route::get('/loans/restructuring', [DashboardController::class, 'loansRestructuring'])->name('loans.restructuring');
    Route::get('/loans/refinancing', [DashboardController::class, 'loansRefinancing'])->name('loans.refinancing');
    Route::get('/loans/write-offs', [DashboardController::class, 'loansWriteOffs'])->name('loans.write-offs');
    Route::get('/loans/products-setup', [DashboardController::class, 'loansProductsSetup'])->name('loans.products-setup');
    Route::get('/loans/interest-config', [DashboardController::class, 'loansInterestConfiguration'])->name('loans.interest-config');
    Route::get('/loans/collateral-mgmt', [DashboardController::class, 'loansCollateralManagement'])->name('loans.collateral-mgmt');
    
    Route::get('/investments/dashboard', [DashboardController::class, 'investmentsDashboard'])->name('investments.dashboard');
    Route::get('/investments/products', [DashboardController::class, 'investmentsProducts'])->name('investments.products');
    Route::get('/investments/open', [DashboardController::class, 'investmentsOpen'])->name('investments.open');
    Route::get('/investments/active', [DashboardController::class, 'investmentsActive'])->name('investments.active');
    Route::get('/investments/matured', [DashboardController::class, 'investmentsMatured'])->name('investments.matured');
    Route::get('/investments/profit-payments', [DashboardController::class, 'investmentsProfitPayments'])->name('investments.profit-payments');
    Route::get('/investments/reports', [DashboardController::class, 'investmentsReports'])->name('investments.reports');
    Route::get('/investments/certificates', [DashboardController::class, 'investmentsCertificates'])->name('investments.certificates');
    
    Route::get('/accounting/ledger', [DashboardController::class, 'accountingLedger'])->name('accounting.ledger');
    Route::get('/accounting/cashbook', [DashboardController::class, 'accountingCashbook'])->name('accounting.cashbook');
    Route::get('/accounting/journals', [DashboardController::class, 'accountingJournals'])->name('accounting.journals');
    Route::get('/accounting/trial-balance', [DashboardController::class, 'accountingTrialBalance'])->name('accounting.trial-balance');
    Route::get('/accounting/profit-loss', [DashboardController::class, 'accountingProfitLoss'])->name('accounting.profit-loss');
    Route::get('/accounting/balance-sheet', [DashboardController::class, 'accountingBalanceSheet'])->name('accounting.balance-sheet');
    Route::get('/accounting/expenses', [DashboardController::class, 'accountingExpenses'])->name('accounting.expenses');
    Route::get('/accounting/income', [DashboardController::class, 'accountingIncome'])->name('accounting.income');
    Route::get('/accounting/bank-rec', [DashboardController::class, 'accountingBankRec'])->name('accounting.bank-rec');
    
    Route::get('/reports/financial', [DashboardController::class, 'reportsFinancial'])->name('reports.financial');
    Route::get('/reports/members', [DashboardController::class, 'reportsMembers'])->name('reports.members');
    Route::get('/reports/savings', [DashboardController::class, 'reportsSavings'])->name('reports.savings');
    Route::get('/reports/loans', [DashboardController::class, 'reportsLoans'])->name('reports.loans');
    Route::get('/reports/audit', [DashboardController::class, 'reportsAudit'])->name('reports.audit');
    Route::get('/reports/risk', [DashboardController::class, 'reportsRisk'])->name('reports.risk');
    
    Route::get('/payments/mpesa', [DashboardController::class, 'paymentsMpesa'])->name('payments.mpesa');
    Route::get('/payments/mobile', [DashboardController::class, 'paymentsMobile'])->name('payments.mobile');
    
    Route::get('/communication', [DashboardController::class, 'communication'])->name('communication');
    Route::get('/formula-engine', [DashboardController::class, 'formulaEngine'])->name('formula.engine');
    Route::get('/security', [DashboardController::class, 'security'])->name('security');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::get('/settings/currency', [DashboardController::class, 'settingsCurrency'])->name('settings.currency');
    Route::get('/settings/interest', [DashboardController::class, 'settingsInterest'])->name('settings.interest');
    Route::get('/settings/penalty', [DashboardController::class, 'settingsPenalty'])->name('settings.penalty');
    Route::get('/settings/fiscal-year', [DashboardController::class, 'settingsFiscalYear'])->name('settings.fiscal-year');
    Route::get('/settings/business-profile', [DashboardController::class, 'settingsBusinessProfile'])->name('settings.business-profile');
    Route::get('/settings/tax', [DashboardController::class, 'settingsTax'])->name('settings.tax');
    Route::get('/settings/number-generation', [DashboardController::class, 'settingsNumberGeneration'])->name('settings.number-generation');
    Route::get('/settings/backup', [DashboardController::class, 'settingsBackup'])->name('settings.backup');
    Route::get('/settings/language', [DashboardController::class, 'settingsLanguage'])->name('settings.language');
    
    Route::get('/notifications/sms', [DashboardController::class, 'notificationsSms'])->name('notifications.sms');
    
    Route::get('/admin/users', [DashboardController::class, 'adminUsers'])->name('admin.users');
    Route::get('/admin/roles', [DashboardController::class, 'adminRoles'])->name('admin.roles');
    Route::get('/admin/performance', [DashboardController::class, 'adminPerformance'])->name('admin.performance');
    
    Route::get('/admin/sessions', [DashboardController::class, 'adminSessions'])->name('admin.sessions');
    Route::get('/admin/ip-restrictions', [DashboardController::class, 'adminIpRestrictions'])->name('admin.ip-restrictions');
    Route::get('/admin/password-policies', [DashboardController::class, 'adminPasswordPolicies'])->name('admin.password-policies');
    Route::get('/admin/encryption', [DashboardController::class, 'adminEncryption'])->name('admin.encryption');
    Route::get('/reports/compliance', [DashboardController::class, 'reportsCompliance'])->name('reports.compliance');
    Route::get('/reports/branch-performance', [DashboardController::class, 'reportsBranchPerformance'])->name('reports.branch-performance');
    Route::get('/reports/staff-performance', [DashboardController::class, 'reportsStaffPerformance'])->name('reports.staff-performance');
    Route::get('/reports/defaulter-analysis', [DashboardController::class, 'reportsDefaulterAnalysis'])->name('reports.defaulter-analysis');
    Route::get('/reports/cashflow-analytics', [DashboardController::class, 'reportsCashflowAnalytics'])->name('reports.cashflow-analytics');
    Route::get('/reports/ai-insights', [DashboardController::class, 'reportsAiInsights'])->name('reports.ai-insights');
    Route::get('/admin/kyc', [DashboardController::class, 'adminKyc'])->name('admin.kyc');
    Route::get('/admin/aml', [DashboardController::class, 'adminAml'])->name('admin.aml');
    Route::get('/admin/fraud', [DashboardController::class, 'adminFraud'])->name('admin.fraud');
    Route::get('/admin/regulatory', [DashboardController::class, 'adminRegulatory'])->name('admin.regulatory');

    Route::get('/admin/failed-logins', [DashboardController::class, 'adminFailedLogins'])->name('admin.failed-logins');
    Route::get('/admin/device-tracking', [DashboardController::class, 'adminDeviceTracking'])->name('admin.device-tracking');
    Route::get('/admin/browser-tracking', [DashboardController::class, 'adminBrowserTracking'])->name('admin.browser-tracking');
    Route::get('/admin/geo-logs', [DashboardController::class, 'adminGeoLogs'])->name('admin.geo-logs');
    Route::get('/admin/active-sessions', [DashboardController::class, 'adminActiveSessions'])->name('admin.active-sessions');
    Route::get('/admin/suspicious-alerts', [DashboardController::class, 'adminSuspiciousAlerts'])->name('admin.suspicious-alerts');

    Route::get('/admin/reminders', [DashboardController::class, 'adminReminders'])->name('admin.reminders');
    Route::get('/admin/due-alerts', [DashboardController::class, 'adminDueAlerts'])->name('admin.due-alerts');
    Route::get('/admin/bulk-sms', [DashboardController::class, 'adminBulkSms'])->name('admin.bulk-sms');
    Route::get('/admin/marketing', [DashboardController::class, 'adminMarketing'])->name('admin.marketing');
    Route::get('/admin/receipts', [DashboardController::class, 'adminReceipts'])->name('admin.receipts');
    Route::get('/admin/otp-settings', [DashboardController::class, 'adminOtpSettings'])->name('admin.otp-settings');

    Route::post('/admin/users', [DashboardController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [DashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [DashboardController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/users/{user}/logs', [DashboardController::class, 'getUserLogs'])->name('admin.users.logs');
    
    Route::get('/admin/audit', [DashboardController::class, 'adminAudit'])->name('admin.audit');
    Route::get('/admin/settings/communication', [DashboardController::class, 'adminCommunicationSettings'])->name('admin.settings.communication');
    Route::post('/admin/comm-settings', [DashboardController::class, 'updateCommSettings'])->name('admin.comm-settings.update');
    Route::post('/admin/bulk-sms', [DashboardController::class, 'updateBulkSms'])->name('admin.bulk-sms.update');
    Route::post('/admin/marketing', [DashboardController::class, 'updateMarketing'])->name('admin.marketing.update');
    Route::post('/admin/receipts', [DashboardController::class, 'updateReceipts'])->name('admin.receipts.update');
    Route::post('/admin/otp-settings', [DashboardController::class, 'updateOtpSettings'])->name('admin.otp-settings.update');
    Route::post('/admin/reminders', [DashboardController::class, 'updateReminders'])->name('admin.reminders.update');
    Route::post('/admin/security', [DashboardController::class, 'updateSecurity'])->name('admin.security.update');
    
    Route::post('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');
    Route::post('/settings/communication', [DashboardController::class, 'updateCommSettings'])->name('settings.communication.update');
    Route::post('/security', [DashboardController::class, 'updateSecurity'])->name('security.update');
    Route::post('/security/2fa', [DashboardController::class, 'toggle2FA'])->name('security.2fa');
    Route::post('/security/password', [DashboardController::class, 'updatePassword'])->name('security.password');
    
    Route::post('/admin/ip-restrictions', [DashboardController::class, 'storeIpRestriction'])->name('admin.ip-restrictions.store');
    Route::delete('/admin/ip-restrictions/{restriction}', [DashboardController::class, 'deleteIpRestriction'])->name('admin.ip-restrictions.delete');
    
    Route::post('/admin/kyc/{kyc}/status', [DashboardController::class, 'updateKycStatus'])->name('admin.kyc.update');
    Route::post('/admin/aml/{alert}/status', [DashboardController::class, 'updateAmlStatus'])->name('admin.aml.update');
    
    Route::delete('/admin/sessions/{id}', [DashboardController::class, 'terminateSession'])->name('admin.sessions.terminate');
    Route::post('/admin/sessions/terminate-all', [DashboardController::class, 'terminateAllSessions'])->name('admin.sessions.terminate-all');
    
    Route::get('/withdrawals/requests', [DashboardController::class, 'withdrawalsRequests'])->name('withdrawals.requests');
});

