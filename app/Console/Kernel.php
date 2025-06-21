<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\EvaluateBids::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Run every minute to check for ad slots that need status updates
        $schedule->command('bids:evaluate')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}