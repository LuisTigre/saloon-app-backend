<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hairstyle_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hairstyle_attribute_id')
                  ->constrained('hairstyle_attributes')
                  ->onDelete('cascade');
            $table->string('value'); // Example: Small, Medium, Large
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hairstyle_attribute_values');
    }
};

