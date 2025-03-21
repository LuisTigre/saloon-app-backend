<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hairstyle_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hairstyle_id')->constrained('hairstyles')->onDelete('cascade');
            $table->string('image_url');
            $table->boolean('is_main_image')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hairstyle_images');
    }
};
