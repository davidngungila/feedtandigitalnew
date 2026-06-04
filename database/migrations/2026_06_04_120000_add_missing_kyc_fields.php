<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kyc_verifications', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('member_id')->constrained()->onDelete('cascade');
            $table->string('type')->nullable()->after('document_type');
            $table->string('selfie_path')->nullable()->after('document_path');
        });
    }

    public function down()
    {
        Schema::table('kyc_verifications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'type', 'selfie_path']);
        });
    }
};
