<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'hairstyle_attribute_value_id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(HairstyleAttributeValue::class, 'hairstyle_attribute_value_id');
    }
}
