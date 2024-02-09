<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\SubscribeRequest;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
   /**
    * Subscribe an email
    *
    * @param \App\Http\Requests\Home\SubscribeRequest $request
    * @return mixed
    */
   public function __invoke(SubscribeRequest $request): mixed
   {
      Subscribe::create($request->validated());

      return response()->json(['message' => 'You have successfully subscribed']);
   }
}
