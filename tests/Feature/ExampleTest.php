<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
   /**
    * A basic test example.
    */
   public function test_the_application_returns_a_successful_response(): void
   {
      // $response = $this->get('/');
      $response = $this->get(route('home.index'));

      $response->assertSee("flourish");
      
      // $response->assertStatus(200);
      $response->assertOk();
   }
   
   /**
    * A basic test example.
    */
   // public function test_a_post_method_returns_a_successful_response(): void
   // {
   //    $response = $this->post(
   //       route("handler.subscribe", ["email" => "dodothegreat@gmail.com"])
   //    );

   //    $response->assertStatus(200);
   // }
}
