<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'label',    // dipakai oleh StatistikController
        'name',     // alias lama, tetap support untuk backward compat
        'value',
        'unit',
        'icon',
        'year',
        'order',
    ];

    protected $casts = [
        'year' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Scope berdasarkan kategori
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category)->orderBy('order');
    }

    /**
     * Scope berdasarkan tahun
     */
    public function scopeYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Accessor: selalu kembalikan label (fallback ke name jika label kosong)
     */
    public function getLabelAttribute($value)
    {
        return $value ?: $this->attributes['name'] ?? '';
    }

    /**
     * Format nilai numerik dengan pemisah ribuan
     */
    public function getFormattedValueAttribute()
    {
        return number_format((float) str_replace([',', '.'], ['', '.'], $this->value), 0, ',', '.');
    }
}
