<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'image',
        'title',
        'link',
        'type',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
