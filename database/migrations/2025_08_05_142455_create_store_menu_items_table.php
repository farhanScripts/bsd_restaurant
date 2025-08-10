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
        Schema::create('store_menu_items', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT

            $table->foreignId('store_id') // FOREIGN KEY NOT NULL
                ->constrained('stores')
                ->onDelete('cascade');

            $table->foreignId('menu_item_id') // FOREIGN KEY NOT NULL
                ->constrained('menu_items')
                ->onDelete('cascade');

            $table->boolean('is_available')->default(true); // DEFAULT TRUE
            $table->decimal('custom_price', 10, 2)->nullable(); // NULLABLE

            $table->timestamp('created_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // ON UPDATE CURRENT_TIMESTAMP

            $table->unique(['store_id', 'menu_item_id']); // UNIQUE KEY
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_menu_items');
    }
};
