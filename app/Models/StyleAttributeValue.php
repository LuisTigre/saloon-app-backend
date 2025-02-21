<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StyleAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'style_id',
        'attribute_id',
        'value',
    ];

    public function style()
    {
        // Relationship with BraidingStyle model.
        return $this->belongsTo(\App\Models\BraidingStyle::class, 'style_id');
    }

    public function attribute()
    {
        return $this->belongsTo(\App\Models\StyleAttribute::class, 'attribute_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(\App\Models\Booking::class, 'booking_style_attribute_value');
    }
}
