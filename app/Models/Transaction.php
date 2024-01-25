<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'finished_product'
    ];

    public function transactionDetails() : HasMany
    {
        return $this->hasMany(TransactionDetails::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->hasOne(Proposal::class);
    }
}
