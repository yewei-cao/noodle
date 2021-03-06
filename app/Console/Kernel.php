<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    	\App\Console\Commands\HandleOrders::class,
//     	\App\Console\Commands\PrintOrders::class,// to print the missing order
    	\App\Console\Commands\SendEmails::class,// to print the missing order
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
        
        $schedule->command('handle:order')
        ->weekly()->sundays()->at('23:55');
        
        $schedule->command('send:emails')
        ->everyFiveMinutes();
        
//         $schedule->command('print:orders')
//         		->everyTenMinutes();

    }
}
