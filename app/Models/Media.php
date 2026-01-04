<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'images',
        'status'
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
