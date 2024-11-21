<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:settle-purchase-order-status')->everyMinute();
        $schedule->command('email:send-weekly')->weekly()->saturdays()->at('00:00');
//         $schedule->command('email:send-weekly')->everyMinute();
        // $schedule->command('email:send-weekly')->weekly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
