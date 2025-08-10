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
        Schema::create('users_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->comment('Reference to users.id');

            $table->string('label', 50)
                ->comment('Address label (home, office, other)');

            $table->string('recipient_name', 255)
                ->comment('Recipient name for delivery');

            $table->string('phone', 20)
                ->comment('Contact phone number');

            $table->string('address_line_1', 500)
                ->comment('Primary address line');

            $table->string('address_line_2', 500)
                ->nullable()
                ->comment('Secondary address line (apartment, unit, etc.)');

            $table->string('city', 100)
                ->comment('City name');

            $table->string('postal_code', 10)
                ->comment('Postal/ZIP code');

            $table->decimal('latitude', 10, 8)
                ->nullable()
                ->comment('GPS latitude coordinate');

            $table->decimal('longitude', 11, 8)
                ->nullable()
                ->comment('GPS longitude coordinate');

            $table->boolean('is_default')
                ->default(false)
                ->comment('Default address flag - only one per user');

            $table->timestamps();

            // Indexes for better query performance
            $table->index('user_id');
            $table->index(['user_id', 'is_default'], 'idx_user_default_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_addresses');
    }
};
