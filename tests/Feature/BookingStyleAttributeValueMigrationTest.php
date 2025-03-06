<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingStyleAttributeValueMigrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_style_attribute_value_table_exists_with_required_columns()
    {
        // Ensure migrations are run
        $this->artisan('migrate');

        // Check the table exists
        $this->assertTrue(
            Schema::hasTable('booking_style_attribute_value'),
            'The pivot table booking_style_attribute_value does not exist.'
        );

        // Verify required columns exist
        $requiredColumns = [
            'id',
            'booking_id',
            'style_attribute_value_id',
            'created_at',
            'updated_at'
        ];

        foreach ($requiredColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('booking_style_attribute_value', $column),
                "Column {$column} is missing in booking_style_attribute_value table."
            );
        }
    }
}