<?php

namespace App\Observers;

use App\Models\Concert;

class ConcertObserver
{
    /**
     * Handle the Concert "creating" event.
     *
     * @param  \App\Models\Concert  $concert
     * @return void
     */
    public function creating(Concert $concert)
    {
        $concert->start_at = dateDmyToYmd($concert->start_at);
        $concert->end_at = dateDmyToYmd($concert->end_at);
    }

    /**
     * Handle the Concert "updating" event.
     *
     * @param  \App\Models\Concert  $concert
     * @return void
     */
    public function updating(Concert $concert)
    {
        $concert->start_at = dateDmyToYmd($concert->start_at);
        $concert->end_at = dateDmyToYmd($concert->end_at);
    }
}
