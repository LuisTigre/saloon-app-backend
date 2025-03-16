<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributePricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'hairstyle_id', 
        'hairstyle_attribute_value_id', 
        'hairstyle_image_id', 
        'additional_cost', 
        'additional_time', 
        'cost_type'
    ];

    public function hairstyle()
    {
        return $this->belongsTo(Hairstyle::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(HairstyleAttributeValue::class);
    }

    public function image()
    {
        return $this->belongsTo(HairstyleImage::class, 'hairstyle_image_id');
    }
}
