<?php

namespace App\Models;

use Carbon\Carbon;
use COM;
use Dotenv\Store\File\Reader;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    const NEW = 'new';
    const READY = 'ready';
    const CLIENT_TO_DO = 'client_to_do';
    const WIP = 'wip';
    const WAITLIST = 'waitlist';
    const PAUSED = 'paused';
    const COMPLETED = 'completed';
    const ARCHIVED = 'archived';
    const PAYPAL = 'paypal';
    const PAID = 'paid';
    const UNPAID = 'unpaid';

    use HasFactory;
    protected $fillable = [
        'user_id',
        'sub_total',
        'discount',
        'grand_total',
        'finished_product',
        'order_id_paypall',
        'payer_id_paypall',
        'payment_id_paypall',
        'proposal_project_subtotal',
        'proposal_project_discount',
        'status',
        'notes_finale'
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
