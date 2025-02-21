<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BraidingStyle extends Model
{
    use HasFactory;

    protected $fillable = [
        'style_name',
        'description',
        'duration',
        'price',
    ];
}
