<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 55)
                ->collation('utf8mb4_0900_ai_ci')
                ->unique();
            $table->string('theme', 55)
                ->collation('utf8mb4_0900_ai_ci')
                ->unique();
            $table->string('copyright', 55)
                ->collation('utf8mb4_0900_ai_ci')
                ->unique();
            $table->text('description')
                ->collation('utf8mb4_0900_ai_ci');
            $table->string('image_path', 191)
                ->collation('utf8mb4_0900_ai_ci')
                ->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
