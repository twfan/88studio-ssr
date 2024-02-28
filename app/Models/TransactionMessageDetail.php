<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMessageDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_message_id',
        'user_id',
        'message',
        'attachment'
    ];
}
