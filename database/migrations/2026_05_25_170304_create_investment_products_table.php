<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investment_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->decimal('interest_rate', 5, 2); // e.g., 18.00%
            $table->integer('min_duration_months');
            $table->decimal('min_amount', 15, 2);
            $table->string('payout_frequency'); // monthly, quarterly, semi-annually, annually, at_maturity
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investment_products');
    }
};
