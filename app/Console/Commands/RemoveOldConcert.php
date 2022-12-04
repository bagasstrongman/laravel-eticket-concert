<?php

namespace App\Console\Commands;

use App\Contracts\Models;
use Illuminate\Console\Command;

class RemoveOldConcert extends Command
{
    /**
     * @var concertInterface
     */
    protected $concertInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'concert:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all expired concert list';

    /**
     * Create a new command instance.
     *
     * @param App\Contracts\Models\ConcertInterface $concertInterface
     * @return void
     */
    public function __construct(Models\ConcertInterface $concertInterface)
    {
        parent::__construct();
        $this->concertInterface = $concertInterface;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Notify when proses in progress
        $this->info('Get expired concert data!');

        // Get expired concerts
        $concerts = $this->concertInterface->all(['*'], [], [['end_at', '<', dateDmyToYmd(now())]]);

        // Notify when starting system
        $this->info('Deleting expired concert data!');

        // Delete expired concerts
        $concerts->each(function($concert) {
            $concert->delete();
        });

        // Notify when proses is done
        return $this->info('Expired concert data successfully deleted!');
    }
}
