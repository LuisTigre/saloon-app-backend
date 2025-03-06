<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HairstyleAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['hairstyle_attribute_id', 'value'];

    public function attribute()
    {
        return $this->belongsTo(HairstyleAttribute::class);
    }

    public function bookings()
    {
        return $this->hasMany(BookingAttributeValue::class);
    }
}
