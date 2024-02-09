<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'discount_id',
        'social_media',
        'use_for',
        'use_for_other',
        'reference',
        'date',
        'previous_work',
        'status',
        'scope',
        'estimated_start',
        'guaranteed_delivery',
        'project_subtotal'
    ];
}
