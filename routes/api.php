<?php

use App\Http\Controllers\Api\MemberAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('member')->group(function () {
    // Public (no auth required)
    Route::post('send-otp', [MemberAuthController::class, 'sendOtp']);
    Route::post('verify-otp', [MemberAuthController::class, 'verifyOtp']);
    Route::post('check-email', [MemberAuthController::class, 'checkEmail']);
    Route::post('register', [MemberAuthController::class, 'registerMember']);
    Route::post('login-first', [MemberAuthController::class, 'loginFirstTime']);
    Route::post('login-pin', [MemberAuthController::class, 'loginWithPin']);
    
    // Protected (needs auth token)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [MemberAuthController::class, 'logout']);
        Route::get('dashboard', [MemberAuthController::class, 'dashboard']);
        Route::get('profile', [MemberAuthController::class, 'getProfile']);
        Route::post('profile', [MemberAuthController::class, 'updateProfile']);
        Route::post('upload-photo', [MemberAuthController::class, 'uploadPhoto']);
        Route::post('change-pin', [MemberAuthController::class, 'changePin']);
        Route::post('change-password', [MemberAuthController::class, 'changePassword']);
        
        // Member Data
        Route::get('savings', [MemberAuthController::class, 'getSavingsAccounts']);
        Route::get('loans', [MemberAuthController::class, 'getLoans']);
        Route::get('investments', [MemberAuthController::class, 'getInvestments']);
        Route::get('transactions', [MemberAuthController::class, 'getTransactions']);
        Route::get('statements', [MemberAuthController::class, 'getStatements']);
        
        // KYC
        Route::post('submit-kyc', [MemberAuthController::class, 'submitKyc']);
        Route::get('kyc-status', [MemberAuthController::class, 'getKycStatus']);
    });
});
