<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Potensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'image',
        'location',
        'gallery',
        'contact',
        'email',
        'website',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($potensi) {
            if (empty($potensi->slug)) {
                $potensi->slug = Str::slug($potensi->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/Pedesaan.jpg');
    }

    public function getGalleryArrayAttribute()
    {
        if (empty($this->gallery))
            return [];
        $decoded = is_string($this->gallery) ? json_decode($this->gallery, true) : $this->gallery;
        return is_array($decoded) ? $decoded : [];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
