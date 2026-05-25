<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add new columns to existing investments table
        Schema::table('investments', function (Blueprint $table) {
            // Check if columns exist before adding (precautionary)
            if (!Schema::hasColumn('investments', 'reference')) {
                $table->string('reference')->after('member_id')->nullable();
                $table->foreignId('investment_product_id')->after('reference')->nullable()->constrained()->onDelete('cascade');
                $table->decimal('total_profit_earned', 15, 2)->after('status')->default(0);
                $table->decimal('total_profit_paid', 15, 2)->after('total_profit_earned')->default(0);
                
                // Rename existing columns to match our new schema if needed, or keep them
                // For now, let's just make sure we can use the table with our new model
            }
        });
    }

    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropForeign(['investment_product_id']);
            $table->dropColumn(['reference', 'investment_product_id', 'total_profit_earned', 'total_profit_paid']);
        });
    }
};
