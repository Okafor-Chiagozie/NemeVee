<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
   /**
    * A basic feature test example.
    */
   public function test_if_admin_is_logged_in(): void
   {
      $response = $this->get(route('home.about'));
      
      $response->assertStatus(200);
   }
}
