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
            $table->string('gender')->nullable()->after('nida');
            $table->date('dob')->nullable()->after('gender');
            $table->string('marital_status')->nullable()->after('dob');
            $table->string('branch')->nullable()->after('membership_type');
            $table->string('po_box')->nullable()->after('street');
            $table->string('next_of_kin_name')->nullable()->after('po_box');
            $table->string('next_of_kin_relationship')->nullable()->after('next_of_kin_name');
            $table->string('next_of_kin_phone')->nullable()->after('next_of_kin_relationship');
            $table->string('passport_photo')->nullable()->after('next_of_kin_phone');
            $table->string('nida_card')->nullable()->after('passport_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'dob',
                'marital_status',
                'branch',
                'po_box',
                'next_of_kin_name',
                'next_of_kin_relationship',
                'next_of_kin_phone',
                'passport_photo',
                'nida_card'
            ]);
        });
    }
};
