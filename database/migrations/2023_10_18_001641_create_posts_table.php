<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::create('posts', function (Blueprint $table) {
         $table->id();
         $table->ulid('nano_id')->unique();
         $table->string('title', 255)->nullable();
         $table->longText('content')->nullable();
         $table->string('image', 35)->default('default.jfif');
         $table->string('type', 15)->default('normal');
         $table->unsignedInteger('views')->default(0);
         $table->char('sent', 1)->default('0');
         $table->softDeletes();
         $table->timestamp('published_at')->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('posts');
   }
};
