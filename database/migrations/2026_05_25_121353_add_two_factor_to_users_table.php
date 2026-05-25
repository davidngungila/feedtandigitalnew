<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('two_factor_enabled')->default(false)->after('last_login_at');
            $table->string('two_factor_type')->nullable()->after('two_factor_enabled'); // 'authenticator', 'sms'
            $table->string('two_factor_secret')->nullable()->after('two_factor_type');
            $table->string('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['two_factor_enabled', 'two_factor_type', 'two_factor_secret', 'two_factor_recovery_codes']);
        });
    }
};
