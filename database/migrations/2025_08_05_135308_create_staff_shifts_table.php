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
        Schema::create('staff_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->comment('Reference to users.id');
            $table->date('shift_date')
                ->comment('Shift Date');
            $table->time('start_time')
                ->comment('Shift Start Time');
            $table->time('end_time')
                ->comment('Shift End Time');    
            $table->enum('status', ['scheduled', 'active','completed', 'missed'])
                ->default('scheduled')
                ->comment('Shift Status');
            $table->text('notes')
                ->nullable()
                ->comment('Additional notes for the shift');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_shifts');
    }
};
