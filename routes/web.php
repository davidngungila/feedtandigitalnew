<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('login');
Route::post('/login', [DashboardController::class, 'login'])->name('do-login');
Route::post('/logout', [DashboardController::class, 'logout'])->name('do-logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/members/active', [DashboardController::class, 'membersActive'])->name('members.active');
    Route::get('/members/register', [DashboardController::class, 'membersRegister'])->name('members.register');
    Route::get('/members/profile', [DashboardController::class, 'membersProfile'])->name('members.profile');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/members/statements', [DashboardController::class, 'membersStatements'])->name('members.statements');
    
    Route::get('/savings/plans', [DashboardController::class, 'savingsPlans'])->name('savings.plans');
    Route::get('/savings/deposit', [DashboardController::class, 'savingsDeposit'])->name('savings.deposit');
    Route::get('/savings/accounts', [DashboardController::class, 'savingsAccounts'])->name('savings.accounts');
    
    Route::get('/loans/apply', [DashboardController::class, 'loansApply'])->name('loans.apply');
    Route::get('/loans/active', [DashboardController::class, 'loansActive'])->name('loans.active');
    Route::get('/loans/repayments', [DashboardController::class, 'loansRepayments'])->name('loans.repayments');
    
    Route::get('/investments/active', [DashboardController::class, 'investmentsActive'])->name('investments.active');
    
    Route::get('/accounting/ledger', [DashboardController::class, 'accountingLedger'])->name('accounting.ledger');
    
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
    
    Route::get('/notifications/sms', [DashboardController::class, 'notificationsSms'])->name('notifications.sms');
    
    Route::get('/admin/users', [DashboardController::class, 'adminUsers'])->name('admin.users');
    Route::get('/admin/audit', [DashboardController::class, 'adminAudit'])->name('admin.audit');
    
    Route::get('/withdrawals/requests', [DashboardController::class, 'withdrawalsRequests'])->name('withdrawals.requests');
});

