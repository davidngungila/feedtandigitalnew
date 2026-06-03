<?php

use App\Http\Controllers\Api\MemberAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('member')->group(function () {
    Route::post('check-email', [MemberAuthController::class, 'checkEmail']);
    Route::post('login-first', [MemberAuthController::class, 'loginFirstTime']);
    Route::post('login-pin', [MemberAuthController::class, 'loginWithPin']);
    Route::post('register', [MemberAuthController::class, 'registerMember']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [MemberAuthController::class, 'logout']);
    });
});
