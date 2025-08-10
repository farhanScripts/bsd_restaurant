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
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
            $table->string('key_name')->unique(); // UNIQUE, NOT NULL
            $table->text('value')->nullable(); // NULL
            $table->text('description')->nullable(); // NULL
            $table->enum('type', ['string', 'integer', 'boolean', 'json']); // ENUM
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // ON UPDATE CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
