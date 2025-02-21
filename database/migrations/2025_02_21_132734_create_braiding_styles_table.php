<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('braiding_styles', function (Blueprint $table) {
            $table->id();
            $table->string('style_name');
            $table->text('description')->nullable();
            $table->integer('duration'); // Duration in minutes
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('braiding_styles');
    }
};