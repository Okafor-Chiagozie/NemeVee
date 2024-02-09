<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Database\Factories\TagFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    */
   public function run(): void
   {
      // \App\Models\Admin::factory(10)->create();

      // \App\Models\Admin::factory()->create([
      //     'name' => 'Test Admin',
      //     'email' => 'test@example.com',
      // ]);



      // Admin::factory(1)
      // ->has(AdminDetail::factory(1), 'admin_detail')
      // ->create();

      // ❗Not sure if this works
      // (But it's meant to, cuz it's just the inverse of the first)
      // AdminDetail::factory(1)
      // ->for(Admin::factory(1), 'admin')->create();
      
      // Tag::factory(4)->create();

      Post::factory(2)
      ->recycle(Tag::factory(2)->create())->create();

      // PostTag::factory()

      // Post::factory(2)
      // ->hasAttached(Tag::factory(2), [], 'tags')->create();

      // PostTag::factory(1)->create();
   }
}
