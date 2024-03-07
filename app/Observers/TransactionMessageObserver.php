<?php

namespace App\Observers;

use App\Models\TransactionMessage;

class TransactionMessageObserver
{
    /**
     * Handle the TransactionMessage "created" event.
     */
    public function created(TransactionMessage $transactionMessage): void
    {
        //
    }

    /**
     * Handle the TransactionMessage "updated" event.
     */
    public function updated(TransactionMessage $transactionMessage): void
    {
        //
    }

    /**
     * Handle the TransactionMessage "deleted" event.
     */
    public function deleted(TransactionMessage $transactionMessage): void
    {
        //
    }

    /**
     * Handle the TransactionMessage "restored" event.
     */
    public function restored(TransactionMessage $transactionMessage): void
    {
        //
    }

    /**
     * Handle the TransactionMessage "force deleted" event.
     */
    public function forceDeleted(TransactionMessage $transactionMessage): void
    {
        //
    }
}
