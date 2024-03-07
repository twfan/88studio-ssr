<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionMessageDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_message_id',
        'user_id',
        'message',
        'attachment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction_message(): BelongsTo
    {
        return $this->belongsTo(TransactionMessage::class);
    }
}
