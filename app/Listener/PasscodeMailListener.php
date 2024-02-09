<?php

namespace App\Listener;

use App\Event\VerifyPasscodeEvent;
use App\Mail\Passcode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Throwable;

use function PHPUnit\Framework\throwException;

class PasscodeMailListener implements ShouldQueue
{
   /**
    * Create the event listener.
    */
   public function __construct()
   {
      //
   }

   /**
    * Handle the event.
    */
   public function handle(VerifyPasscodeEvent $event): void
   {
      Mail::to($event->email)->send(new Passcode($event->code));
   }

   // public $tries = 2;

   public function failed(VerifyPasscodeEvent $event ,Throwable $e)
   {
      info('This job has failed!');
   }
}
