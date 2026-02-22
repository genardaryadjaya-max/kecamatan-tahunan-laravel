<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Desa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'website_url',
        'logo',
        'contact',
        'social_media',
        'is_active',
    ];

    protected $casts = [
        'contact' => 'array',
        'social_media' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($desa) {
            if (empty($desa->slug)) {
                $desa->slug = Str::slug($desa->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/logo-jepara.png');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
