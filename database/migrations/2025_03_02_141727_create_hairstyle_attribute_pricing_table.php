<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attribute_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hairstyle_id')->constrained('hairstyles')->onDelete('cascade');
            $table->foreignId('hairstyle_attribute_value_id')
                  ->constrained('hairstyle_attribute_values')
                  ->onDelete('cascade');
            $table->decimal('additional_cost', 8, 2)->default(0);
            $table->enum('cost_type', ['fixed', 'percentage'])->default('fixed');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('attribute_pricings');
    }
};
