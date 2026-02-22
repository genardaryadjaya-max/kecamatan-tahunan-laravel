<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unduhan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'file_path',
        'file_size',
        'file_type',
        'downloads_count',
    ];

    protected $casts = [
        'downloads_count' => 'integer',
    ];

    public function getDownloadUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function incrementDownloads()
    {
        $this->increment('downloads_count');
    }
}
