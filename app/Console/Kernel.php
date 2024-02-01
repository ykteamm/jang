<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('battle:elchi')
        ->dailyAt('11:52');

        $schedule->command('battleEnd:elchi')
        ->dailyAt('23:55');

        // $schedule->command('ksb:battle')
        // ->dailyAt('23:45');

        $schedule->command('shift:close')
        ->dailyAt('23:58');

        // $schedule->command('battle:news')
        // ->everyMinute();
        // $schedule->command('battle:news')
        // ->cron("30 04 * * 5");

        // $schedule->command('kingsold:liga')
        // ->cron("30 02 * * 5");

        // $schedule->command('create:liga')
        // ->monthlyOn(1, '00:10');

        $schedule->command('create:plan')
        ->monthlyOn(1, '00:10');

        // $schedule->command('turnir:battle')
        // ->dailyAt('23:59');

        // $schedule->command('turnir:playoff')
        // ->dailyAt('00:10');
        // ->monthlyOn(1, '00:10');

        // $schedule->command('create:karmaball')
        // ->dailyAt('23:50');
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
