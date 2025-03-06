<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hairstyle_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Example: Braid Size, Hair Length
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hairstyle_attributes');
    }
};
