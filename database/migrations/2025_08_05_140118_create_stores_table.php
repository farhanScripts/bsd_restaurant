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
        Schema::create('stores', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
            $table->string('name'); // NOT NULL
            $table->string('slug')->unique(); // UNIQUE, NOT NULL
            $table->string('phone', 20); // NOT NULL
            $table->string('email')->nullable(); // NULL
            $table->text('address'); // NOT NULL
            $table->string('city', 100); // NOT NULL
            $table->string('postal_code', 10)->nullable(); // NULL

            $table->decimal('latitude', 10, 8); // NOT NULL
            $table->decimal('longitude', 11, 8); // NOT NULL

            $table->integer('delivery_radius_km')->default(5); // DEFAULT 5
            $table->decimal('min_order_amount', 10, 2)->default(0); // DEFAULT 0
            $table->decimal('delivery_fee', 8, 2)->default(0); // DEFAULT 0
            $table->integer('estimated_delivery_time')->default(30); // DEFAULT 30

            $table->time('opening_time'); // NOT NULL
            $table->time('closing_time'); // NOT NULL

            $table->boolean('is_active')->default(true); // DEFAULT TRUE

            $table->timestamp('created_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // ON UPDATE CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
