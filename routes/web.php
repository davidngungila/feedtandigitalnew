<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\SavingsReportController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberPortalController;

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
    Route::get('/members/documents', [DashboardController::class, 'membersDocuments'])->name('members.documents');
    Route::get('/members/blacklisted', [DashboardController::class, 'membersBlacklisted'])->name('members.blacklisted');
    Route::get('/members/types', [DashboardController::class, 'memberTypes'])->name('members.types');
    
    // Savings & Deposits
    Route::prefix('savings')->name('savings.')->group(function () {
        Route::get('/dashboard', [SavingsController::class, 'dashboard'])->name('dashboard');
        Route::get('/accounts', [SavingsController::class, 'accounts'])->name('accounts');
        Route::get('/accounts/create', [SavingsController::class, 'createAccount'])->name('accounts.create');
        Route::post('/accounts', [SavingsController::class, 'storeAccount'])->name('accounts.store');
        Route::get('/products', [SavingsController::class, 'products'])->name('products');
        Route::post('/products', [SavingsController::class, 'storeProduct'])->name('products.store');
    });

    Route::prefix('deposits')->name('deposits.')->group(function () {
        Route::get('/new', [DepositController::class, 'new'])->name('new');
        Route::post('/', [DepositController::class, 'store'])->name('store');
        Route::get('/history', [DepositController::class, 'history'])->name('history');
        Route::get('/bulk', [DepositController::class, 'bulk'])->name('bulk');
        Route::get('/mobile', [DepositController::class, 'mobile'])->name('mobile');
        Route::get('/pending', [DepositController::class, 'pending'])->name('pending');
        Route::get('/reports', [DepositController::class, 'reports'])->name('reports');
    });

    Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
        Route::get('/new', [WithdrawalController::class, 'new'])->name('new');
        Route::post('/', [WithdrawalController::class, 'store'])->name('store');
        Route::get('/requests', [WithdrawalController::class, 'requests'])->name('requests');
        Route::get('/history', [WithdrawalController::class, 'history'])->name('history');
        Route::get('/approved', [WithdrawalController::class, 'approved'])->name('approved');
        Route::get('/rejected', [WithdrawalController::class, 'rejected'])->name('rejected');
        Route::post('/{withdrawalRequest}/approve', [WithdrawalController::class, 'approve'])->name('approve');
        Route::post('/{withdrawalRequest}/reject', [WithdrawalController::class, 'reject'])->name('reject');
    });

    Route::prefix('interest')->name('interest.')->group(function () {
        Route::get('/rules', [InterestController::class, 'rules'])->name('rules');
        Route::post('/rules', [InterestController::class, 'storeRule'])->name('rules.store');
        Route::get('/posting', [InterestController::class, 'posting'])->name('posting');
        Route::post('/posting', [InterestController::class, 'processPosting'])->name('posting.process');
        Route::get('/history', [InterestController::class, 'history'])->name('history');
    });

    Route::prefix('statements')->name('statements.')->group(function () {
        Route::get('/member', [StatementController::class, 'member'])->name('member');
        Route::get('/savings', [StatementController::class, 'savings'])->name('savings');
        Route::get('/download', [StatementController::class, 'download'])->name('download');
        Route::get('/view', [StatementController::class, 'generate'])->name('view');
    });

    Route::prefix('reports/savings')->name('reports.savings.')->group(function () {
        Route::get('/summary', [SavingsReportController::class, 'summary'])->name('summary');
        Route::get('/deposits', [SavingsReportController::class, 'deposits'])->name('deposits');
        Route::get('/withdrawals', [SavingsReportController::class, 'withdrawals'])->name('withdrawals');
        Route::get('/branch', [SavingsReportController::class, 'branch'])->name('branch');
    });

    Route::get('/loans/dashboard', [DashboardController::class, 'loansDashboard'])->name('loans.dashboard');
    Route::get('/loans/apply', [DashboardController::class, 'loansApply'])->name('loans.apply');
    Route::post('/loans/apply', [DashboardController::class, 'loansStore'])->name('loans.store');
    Route::get('/loans/active', [DashboardController::class, 'loansActive'])->name('loans.active');
    Route::get('/loans/approval-workflow', [DashboardController::class, 'loansApprovalWorkflow'])->name('loans.approval-workflow');
    Route::get('/loans/repayments', [DashboardController::class, 'loansRepayments'])->name('loans.repayments');
    Route::get('/loans/products-setup', [DashboardController::class, 'loansProductsSetup'])->name('loans.products-setup');
    
    Route::get('/investments/dashboard', [DashboardController::class, 'investmentsDashboard'])->name('investments.dashboard');
    Route::get('/investments/products', [DashboardController::class, 'investmentsProducts'])->name('investments.products');
    Route::get('/investments/open', [DashboardController::class, 'investmentsOpen'])->name('investments.open');
    Route::get('/investments/active', [DashboardController::class, 'investmentsActive'])->name('investments.active');
    Route::get('/investments/matured', [DashboardController::class, 'investmentsMatured'])->name('investments.matured');
    Route::get('/investments/profit-payments', [DashboardController::class, 'investmentsProfitPayments'])->name('investments.profit-payments');
    Route::get('/investments/reports', [DashboardController::class, 'investmentsReports'])->name('investments.reports');
    Route::get('/investments/certificates', [DashboardController::class, 'investmentsCertificates'])->name('investments.certificates');
    
    Route::get('/payments/mpesa', [DashboardController::class, 'paymentsMpesa'])->name('payments.mpesa');
    Route::get('/payments/mobile', [DashboardController::class, 'paymentsMobile'])->name('payments.mobile');
    
    Route::get('/communication', [DashboardController::class, 'communication'])->name('communication');
    Route::get('/formula-engine', [DashboardController::class, 'formulaEngine'])->name('formula.engine');
    Route::get('/security', [DashboardController::class, 'security'])->name('security');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::get('/settings/currency', [DashboardController::class, 'settingsCurrency'])->name('settings.currency');
    Route::get('/settings/fiscal-year', [DashboardController::class, 'settingsFiscalYear'])->name('settings.fiscal-year');
    Route::get('/settings/business-profile', [DashboardController::class, 'settingsBusinessProfile'])->name('settings.business-profile');
    Route::get('/settings/backup', [DashboardController::class, 'settingsBackup'])->name('settings.backup');
    Route::get('/settings/language', [DashboardController::class, 'settingsLanguage'])->name('settings.language');
    
    Route::get('/notifications/sms', [DashboardController::class, 'notificationsSms'])->name('notifications.sms');
    
    Route::get('/admin/users', [DashboardController::class, 'adminUsers'])->name('admin.users');
    Route::get('/admin/roles', [DashboardController::class, 'adminRoles'])->name('admin.roles');
    Route::get('/admin/kyc', [DashboardController::class, 'adminKyc'])->name('admin.kyc');
    
    Route::get('/admin/sessions', [DashboardController::class, 'adminSessions'])->name('admin.sessions');
    Route::get('/admin/ip-restrictions', [DashboardController::class, 'adminIpRestrictions'])->name('admin.ip-restrictions');
    Route::get('/admin/password-policies', [DashboardController::class, 'adminPasswordPolicies'])->name('admin.password-policies');

    Route::get('/admin/failed-logins', [DashboardController::class, 'adminFailedLogins'])->name('admin.failed-logins');
    Route::get('/admin/device-tracking', [DashboardController::class, 'adminDeviceTracking'])->name('admin.device-tracking');
    Route::get('/admin/browser-tracking', [DashboardController::class, 'adminBrowserTracking'])->name('admin.browser-tracking');
    Route::get('/admin/geo-logs', [DashboardController::class, 'adminGeoLogs'])->name('admin.geo-logs');
    Route::get('/admin/active-sessions', [DashboardController::class, 'adminActiveSessions'])->name('admin.active-sessions');
    Route::get('/admin/suspicious-alerts', [DashboardController::class, 'adminSuspiciousAlerts'])->name('admin.suspicious-alerts');

    Route::get('/admin/bulk-sms', [DashboardController::class, 'adminBulkSms'])->name('admin.bulk-sms');

    Route::post('/admin/users', [DashboardController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [DashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [DashboardController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/users/{user}/logs', [DashboardController::class, 'getUserLogs'])->name('admin.users.logs');
    
    Route::get('/admin/audit', [DashboardController::class, 'adminAudit'])->name('admin.audit');
    Route::get('/admin/settings/communication', [DashboardController::class, 'adminCommunicationSettings'])->name('admin.settings.communication');
    Route::post('/admin/comm-settings', [DashboardController::class, 'updateCommSettings'])->name('admin.comm-settings.update');
    Route::post('/admin/bulk-sms', [DashboardController::class, 'updateBulkSms'])->name('admin.bulk-sms.update');
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
    
    Route::get('/withdrawals/requests', [WithdrawalController::class, 'requests'])->name('withdrawals.requests');


});

