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
        Schema::table('savings_accounts', function (Blueprint $table) {
            $table->foreignId('savings_product_id')->nullable()->after('member_id')->constrained()->onDelete('set null');
            $table->string('opening_balance')->default(0)->after('balance');
            $table->string('currency')->default('TZS')->after('opening_balance');
            $table->date('last_interest_posting_date')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('savings_accounts', function (Blueprint $table) {
            $table->dropForeign(['savings_product_id']);
            $table->dropColumn(['savings_product_id', 'opening_balance', 'currency', 'last_interest_posting_date']);
        });
    }
};
