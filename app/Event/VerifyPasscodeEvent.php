<?php

namespace App\Event;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VerifyPasscodeEvent
{
   use Dispatchable, InteractsWithSockets, SerializesModels;

   /**
    * Create a new event instance.
    */
   public function __construct(public string $email, public int $code)
   {
      //
   }

   /**
    * Get the channels the event should broadcast on.
    *
    * @return array<int, \Illuminate\Broadcasting\Channel>
    */
   public function broadcastOn(): array
   {
      return [
         new PrivateChannel('channel-name'),
      ];
   }
}
