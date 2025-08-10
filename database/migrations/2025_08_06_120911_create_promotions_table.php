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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
            $table->string('code', 50)->unique(); // VARCHAR(50) UNIQUE NOT NULL
            $table->string('name', 255); // VARCHAR(255) NOT NULL
            $table->text('description')->nullable(); // TEXT NULL
            $table->enum('type', ['percentage', 'fixed_amount', 'free_delivery', 'buy_x_get_y']); // ENUM NOT NULL
            $table->decimal('value', 10, 2); // DECIMAL(10,2) NOT NULL
            $table->decimal('min_order_amount', 10, 2)->default(0); // DECIMAL(10,2) DEFAULT 0
            $table->decimal('max_discount_amount', 10, 2)->nullable(); // DECIMAL(10,2) NULL
            $table->integer('usage_limit')->nullable(); // INT NULL
            $table->integer('usage_limit_per_user')->default(1); // INT DEFAULT 1
            $table->integer('used_count')->default(0); // INT DEFAULT 0
            $table->timestamp('valid_from'); // TIMESTAMP NOT NULL
            $table->timestamp('valid_until'); // TIMESTAMP NOT NULL
            $table->boolean('is_active')->default(true); // BOOLEAN DEFAULT TRUE
            $table->timestamps(); // created_at (DEFAULT CURRENT_TIMESTAMP) & updated_at (ON UPDATE CURRENT_TIMESTAMP)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
