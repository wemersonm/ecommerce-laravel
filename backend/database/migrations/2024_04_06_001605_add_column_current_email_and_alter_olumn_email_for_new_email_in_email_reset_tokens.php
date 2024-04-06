<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('email_reset_tokens', function (Blueprint $table) {
            $table->string('current_email', 400)->after('id');
            $table->renameColumn('email', 'new_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_reset_tokens', function (Blueprint $table) {
            $table->dropColumn('current_email');
            $table->renameColumn('new_email', 'email');
        });
    }
};
