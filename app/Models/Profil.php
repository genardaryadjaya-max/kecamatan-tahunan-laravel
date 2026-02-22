<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $guarded = []; // Allow all fields

    /**
     * Scope untuk query berdasarkan slug/type
     * ProfilController publik menggunakan Profil::type('sejarah')
     */
    public function scopeType($query, $type)
    {
        return $query->where('slug', $type);
    }

    /**
     * Scope berdasarkan key section
     */
    public function scopeSection($query, $section)
    {
        return $query->where('slug', $section);
    }

    /**
     * Gunakan slug sebagai route key untuk model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Helper to get image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-profil.jpg');
    }
}
