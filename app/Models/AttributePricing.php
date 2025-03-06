<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributePricing extends Model
{
    use HasFactory;

    protected $fillable = ['hairstyle_id', 'hairstyle_attribute_value_id', 'additional_cost', 'cost_type'];

    public function hairstyle()
    {
        return $this->belongsTo(Hairstyle::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(HairstyleAttributeValue::class);
    }
}
