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
        Schema::create('interest_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('savings_account_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->date('posting_date');
            $table->date('period_start');
            $table->date('period_end');
            $table->string('status')->default('posted'); // pending, posted, reversed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_postings');
    }
};
