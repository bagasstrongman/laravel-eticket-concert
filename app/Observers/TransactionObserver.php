<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "creating" event.
     *
     * @param  \App\Models\Transaction $transaction
     * @return void
     */
    public function creating(Transaction $transaction)
    {
        $transaction->payment_date = dateDmyToYmd($transaction->payment_date);
    }

    /**
     * Handle the Transaction "updating" event.
     *
     * @param  \App\Models\Transaction $transaction
     * @return void
     */
    public function updating(Transaction $transaction)
    {
        $transaction->payment_date = dateDmyToYmd($transaction->payment_date);
    }
}
