<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'channel'
    ];

    public function transaction_message_detail () {
        return $this->hasMany(TransactionMessageDetail::class);
    }
}
