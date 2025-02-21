<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StyleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'style_id',
        'image_url',
        'is_main_image',
    ];

    public function style()
    {
        return $this->belongsTo(BraidingStyle::class, 'style_id');
    }
}
