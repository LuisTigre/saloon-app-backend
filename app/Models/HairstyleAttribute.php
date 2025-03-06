<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HairstyleAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function values()
    {
        return $this->hasMany(HairstyleAttributeValue::class);
    }
}
