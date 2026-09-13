<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'project_code',
        'title',
        'description',
        'image',
        'project_url',
        'client_id',
        'admin_id',
        'client_name',
        'client_company',
        'client_email',
        'client_phone',
        'client_address',
        'project_amount',
        'amount_paid',
        'balance',
        'start_date',
        'deadline',
        'end_date',
        'agreement_file',
        'proposal_file',
        'status',
        'progress_percentage',
        'milestones',
    ];

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
        'end_date' => 'date',
        'milestones' => 'array',
        'project_amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function updates(): HasMany
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class);
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

    public function getStatusTextAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->status ?? 'planning'));
    }

    public function getBalanceDueAttribute(): float
    {
        return $this->calculatedBalance();
    }

    public function getBalanceAttribute(): float
    {
        return $this->calculatedBalance();
    }

    private function calculatedBalance(): float
    {
        return max(0, round((float) $this->project_amount - (float) $this->amount_paid, 2));
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['planning', 'pending', 'in_progress', 'review']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeForClient($query, User $user)
    {
        return $query->where(function ($query) use ($user) {
            $query->where('client_id', $user->id)
                ->orWhere('client_email', $user->email);
        });
    }
}

