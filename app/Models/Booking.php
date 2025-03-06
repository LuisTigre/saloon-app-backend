<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'hairstyle_id',
        'appointment_date',
        'start_time',
        'end_time',
        'total_price',
        'status'
    ];

    public function hairstyle()
    {
        return $this->belongsTo(Hairstyle::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(BookingAttributeValue::class);
    }
}
