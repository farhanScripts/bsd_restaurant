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
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
            $table->string('name'); // NOT NULL
            $table->string('slug')->unique(); // UNIQUE, NOT NULL
            $table->text('description')->nullable(); // NULL
            $table->string('image')->nullable(); // NULL (URL image)
            $table->integer('sort_order')->default(0); // DEFAULT 0
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
        Schema::dropIfExists('menu_categories');
    }
};
