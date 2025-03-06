<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('booking_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')
                  ->constrained() // references bookings(id) by default
                  ->onDelete('cascade');

            $table->foreignId('hairstyle_attribute_value_id')
                  ->constrained('hairstyle_attribute_values') // references hairstyle_attribute_values(id) by default
                  ->onDelete('cascade')
                  ->name('bav_havalue_fk'); // Custom FK name

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('booking_attribute_values');
    }
};
