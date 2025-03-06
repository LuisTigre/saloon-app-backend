<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hairstyle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'duration', 'price'];

    public function images()
    {
        return $this->hasMany(HairstyleImage::class);
    }

    public function attributePricings()
    {
        return $this->hasMany(AttributePricing::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
