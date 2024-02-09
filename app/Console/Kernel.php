<?php

namespace App\Console;

use App\Jobs\BulkEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
   /**
    * Define the application's command schedule.
    */
   protected function schedule(Schedule $schedule): void
   {
      // $schedule->command('inspire')->hourly();
      // $schedule->command('inspire')->dailyAt('4:00');

      // $schedule->command('sitemap:generate')->daily();
      // $schedule->job(new BulkEmail)->dailyAt('20:30');
   }

   /**
    * Register the commands for the application.
    */
   protected function commands(): void
   {
      $this->load(__DIR__ . '/Commands');

      require base_path('routes/console.php');
   }
}
