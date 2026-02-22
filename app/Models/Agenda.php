<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date_time',
        'location',
        'link',
        'is_active',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'is_active' => 'boolean',
    ];
}
