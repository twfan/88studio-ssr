<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory;
    use SoftDeletes;

    const FIXED = 'fixed';
    const PERCENT = 'percent';
    const SINGLE = 'single';
    const MULTIPLE = 'multiple';
    const EVERYONE = 'everyone';
    const TWO_TIMES = 'buy_more_2';

    protected $fillable = [
        'name',
        'amount_type',
        'amount',
        'limitation',
        'target_customer',
        'status'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
