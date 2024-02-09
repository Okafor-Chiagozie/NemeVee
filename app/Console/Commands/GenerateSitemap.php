<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'sitemap:generate';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Automatically generate an XML sitemap';

   /**
    * Execute the console command.
    */
   public function handle()
   {
      SitemapGenerator::create('http://127.0.0.1:8000')
      ->writeToFile(public_path('sitemap.xml'));
   }
}
