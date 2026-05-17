<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Members table
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('member_no')->unique();
            $table->string('nida')->nullable();
            $table->string('phone')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('ward')->nullable();
            $table->string('street')->nullable();
            $table->string('membership_type')->default('Regular'); // Regular, Group, Junior
            $table->string('status')->default('Active'); // Active, Inactive, Suspended
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();
        });

        // Savings Accounts
        Schema::create('savings_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->string('account_no')->unique();
            $table->string('product_type'); // RDA, Emergency, FLEX, SWF, Share Capital
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('target_amount', 15, 2)->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });

        // Loans
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->string('loan_no')->unique();
            $table->string('loan_type'); // Emergency, Development, Business, Education, Housing
            $table->decimal('principal', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('term_months');
            $table->decimal('balance', 15, 2);
            $table->decimal('installment_amount', 15, 2);
            $table->string('status')->default('pending'); // pending, approved, active, paid, overdue, rejected
            $table->text('purpose')->nullable();
            $table->timestamp('disbursed_at')->nullable();
            $table->date('next_due_date')->nullable();
            $table->timestamps();
        });

        // Investments
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->string('plan_name');
            $table->decimal('principal', 15, 2);
            $table->decimal('roi_rate', 5, 2);
            $table->decimal('expected_returns', 15, 2);
            $table->date('start_date');
            $table->date('maturity_date');
            $table->string('status')->default('Active'); // Active, Matured, Pending
            $table->timestamps();
        });

        // Transactions
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('savings_account_id')->nullable()->constrained('savings_accounts')->onDelete('set null');
            $table->foreignId('loan_id')->nullable()->constrained('loans')->onDelete('set null');
            $table->string('type'); // deposit, withdrawal, loan-repayment
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after', 15, 2);
            $table->string('channel'); // M-Pesa, Airtel Money, Cash, Bank, etc.
            $table->string('reference')->unique();
            $table->text('narration')->nullable();
            $table->timestamps();
        });

        // Audit Logs
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('action');
            $table->string('module');
            $table->string('ip_address', 45)->nullable();
            $table->boolean('success')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('investments');
        Schema::dropIfExists('loans');
        Schema::dropIfExists('savings_accounts');
        Schema::dropIfExists('members');
    }
};
