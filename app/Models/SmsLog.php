<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = [
        'recipient',
        'message',
        'status',
        'sender_id',
        'sent_by',
        'error_message',
        'response_data',
    ];

    protected $casts = [
        'response_data' => 'array',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}