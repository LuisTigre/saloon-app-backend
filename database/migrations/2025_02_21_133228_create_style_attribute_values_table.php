<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('style_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('style_id')->constrained('braiding_styles')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('style_attributes')->onDelete('cascade');
            $table->string('value'); // Example: Small, Medium, Large
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('style_attribute_values');
    }
};
