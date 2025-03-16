<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HairstyleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hairstyle_id',
        'image_url',
        'is_main_image',
    ];

    public function hairstyle()
    {
        return $this->belongsTo(Hairstyle::class);
    }
}
