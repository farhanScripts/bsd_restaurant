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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT

            $table->foreignId('category_id') // BIGINT UNSIGNED, FOREIGN KEY
                ->constrained('menu_categories')
                ->onDelete('cascade');

            $table->string('name'); // NOT NULL
            $table->string('slug'); // NOT NULL
            $table->text('description')->nullable(); // NULL
            $table->string('image')->nullable(); // NULL
            $table->decimal('base_price', 10, 2); // NOT NULL
            $table->integer('calories')->nullable(); // NULL
            $table->integer('preparation_time')->default(15); // DEFAULT 15

            $table->boolean('is_vegetarian')->default(false); // DEFAULT FALSE
            $table->boolean('is_vegan')->default(false); // DEFAULT FALSE
            $table->boolean('is_gluten_free')->default(false); // DEFAULT FALSE
            $table->boolean('is_spicy')->default(false); // DEFAULT FALSE

            $table->text('ingredients')->nullable(); // NULL
            $table->boolean('is_available')->default(true); // DEFAULT TRUE
            $table->integer('sort_order')->default(0); // DEFAULT 0

            $table->timestamp('created_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // ON UPDATE CURRENT_TIMESTAMP

            // Indexes for better query performance
            $table->index('category_id');
            $table->index(['category_id', 'is_available'], 'idx_category_available_items');
            $table->index('slug');
            $table->index(['is_available', 'sort_order'], 'idx_available_sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
