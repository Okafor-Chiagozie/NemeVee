<?php

namespace App\Providers;

use App\Models\Tag;
use App\Utils\Extra;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    */
   public function register(): void
   {
      // $this->app->bind('extra', function() {
      //    return new Extra;
      // });
   }

   /**
    * Bootstrap any application services.
    */
   public function boot(): void
   {
      View::share('tags', Tag::all());

      Password::defaults(function(){
         return Password::min(6)->mixedCase()->numbers()->symbols()->uncompromised(3); 
      });
   }
}
