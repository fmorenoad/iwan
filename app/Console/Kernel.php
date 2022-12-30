<?php

namespace App\Console;

use App\Console\Commands\GetPasesDiarios;
use App\Console\Commands\GetPasesDiariosInterurbanos;
use App\Console\Commands\GetPasesDiariosUrbanos;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        GetPasesDiarios::class,
        GetPasesDiariosUrbanos::class,
        GetPasesDiariosInterurbanos::class
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('pasesdiariosurbanos:get')->hourly();
        $schedule->command('pasesdiariosinterurbanos:get')->hourly();
        $schedule->command('pasesdiarios:get')->hourly();
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
