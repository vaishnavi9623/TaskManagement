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
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('email'); 
            $table->string('status')->default('active')->after('photo'); 
            $table->string('role')->default('user')->after('status'); 
            $table->timestamp('last_login_at')->nullable()->after('role'); 
            $table->string('phone_number')->nullable()->after('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['photo', 'status', 'role', 'last_login_at', 'phone_number']);

        });
    }
};
