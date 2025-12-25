<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AidResource extends Model
{
    protected $fillable = [
        'name',
        'category',
        'region',
        'description',
        'phone',
        'email',
        'website',
        'address',
        'hours',
        'tags',
        'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];
}

