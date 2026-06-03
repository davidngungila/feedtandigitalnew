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
        Schema::table('members', function (Blueprint $table) {
            $table->boolean('mobile_lock')->default(false)->after('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('pin_is_set')->default(false)->after('pin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('mobile_lock');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pin_is_set');
        });
    }
};
