<?php

namespace App\Jobs;

use App\Mail\Passcode;
use App\Models\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BulkEmail implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   /**
    * Create a new job instance.
    */
   public function __construct()
   {
      //
   }

   /**
    * Execute the job.
    */
   public function handle(): void
   {
      $all_email = Subscribe::pluck('email');

      foreach ($all_email as $email) {
         Mail::to($email)->send(new Passcode(3322));
      }
   }
}
