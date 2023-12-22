<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sub_total',
        'discount',
        'grand_total',
    ];

    public function transactionDetails() : HasMany
    {
        return $this->hasMany(TransactionDetails::class);
    }
}
