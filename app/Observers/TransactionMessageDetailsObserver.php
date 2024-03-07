<?php

namespace App\Observers;

use App\Models\TransactionMessageDetail;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class TransactionMessageDetailsObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the TransactionMessageDetail "created" event.
     */
    public function created(TransactionMessageDetail $transactionMessageDetail): void
    {
        //
        if ($transactionMessageDetail->user->role == 'super_admin') {
            $transactionMessageDetail->transaction_message->update(['last_chat_from' => 'admin']);
        } else {
            $transactionMessageDetail->transaction_message->update(['last_chat_from' => 'user']);
        }
    }

    /**
     * Handle the TransactionMessageDetail "updated" event.
     */
    public function updated(TransactionMessageDetail $transactionMessageDetail): void
    {
        //
    }

    /**
     * Handle the TransactionMessageDetail "deleted" event.
     */
    public function deleted(TransactionMessageDetail $transactionMessageDetail): void
    {
        //
    }

    /**
     * Handle the TransactionMessageDetail "restored" event.
     */
    public function restored(TransactionMessageDetail $transactionMessageDetail): void
    {
        //
    }

    /**
     * Handle the TransactionMessageDetail "force deleted" event.
     */
    public function forceDeleted(TransactionMessageDetail $transactionMessageDetail): void
    {
        //
    }
}
