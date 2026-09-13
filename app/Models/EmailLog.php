<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'subject',
        'message',
        'recipient_count',
        'sent_by',
        'status',
        'error_message',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}