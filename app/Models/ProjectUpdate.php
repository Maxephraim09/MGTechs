<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectUpdate extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'content',
        'admin_update',
        'client_feedback',
        'rating',
        'status',
        'project_url',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return [
            'planning' => 'bg-gray-500/20 text-gray-400',
            'pending' => 'bg-yellow-500/20 text-yellow-400',
            'in_progress' => 'bg-blue-500/20 text-blue-400',
            'review' => 'bg-purple-500/20 text-purple-400',
            'completed' => 'bg-green-500/20 text-green-400',
            'cancelled' => 'bg-red-500/20 text-red-400',
        ][$this->status] ?? 'bg-gray-500/20 text-gray-400';
    }

    public function getRatingStarsAttribute(): string
    {
        return $this->rating ? str_repeat('*', $this->rating) : '';
    }
}

