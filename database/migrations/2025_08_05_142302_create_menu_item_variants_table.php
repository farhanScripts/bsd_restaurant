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
        Schema::create('menu_item_variants', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT

            $table->foreignId('menu_item_id') // BIGINT UNSIGNED, FOREIGN KEY
                ->constrained('menu_items')
                ->onDelete('cascade');

            $table->string('name'); // NOT NULL
            $table->string('type', 50); // NOT NULL
            $table->decimal('price_modifier', 8, 2)->default(0); // DEFAULT 0
            $table->boolean('is_default')->default(false); // DEFAULT FALSE
            $table->boolean('is_available')->default(true); // DEFAULT TRUE
            $table->integer('sort_order')->default(0); // DEFAULT 0

            $table->timestamp('created_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // ON UPDATE CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_variants');
    }
};
