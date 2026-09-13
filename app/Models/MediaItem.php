<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'type',
        'summary',
        'body',
        'file_path',
        'file_name',
        'mime_type',
        'external_url',
        'is_published',
        'views_count',
        'downloads_count',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}

