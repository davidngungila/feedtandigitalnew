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
        Schema::create('savings_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->decimal('interest_rate', 5, 2)->default(0);
            $table->decimal('min_balance', 15, 2)->default(0);
            $table->string('interest_calculation_method')->default('daily'); // daily, monthly, quarterly, yearly
            $table->string('interest_posting_frequency')->default('monthly'); // monthly, quarterly, yearly
            $table->boolean('allow_overdraft')->default(false);
            $table->decimal('overdraft_limit', 15, 2)->default(0);
            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings_products');
    }
};
