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
            $table->string('password')->nullable()->change();
            $table->string('phone')->nullable();
            $table->string('google_id')->unique()->nullablle();
            $table->string('avatar')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->enum('role', ['customer', 'staff', 'manager', 'admin']);
            $table->enum('status', ['active', 'inactive', 'banned']);
            $table->integer('loyalty_points')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'google_id', 'avatar', 'date_of_birth', 'gender', 'role', 'status', 'loyalty_points']);
            $table->string('password')->nullable(false)->change();
        });
    }
};
