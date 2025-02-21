<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'style_id',
        'appointment_date',
        'start_time',
        'end_time',
        'total_price',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function style()
    {
        return $this->belongsTo(BraidingStyle::class, 'style_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(\App\Models\StyleAttributeValue::class, 'booking_style_attribute_value');
    }
}
