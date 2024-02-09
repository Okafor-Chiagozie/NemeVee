<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(HomeController::class)->name('home.')->group(function() {

   Route::get('/', 'index')->name('index');
   Route::get('/about', 'about')->name('about');
   Route::get('/category/{category?}', 'category')->name('category');
   Route::get('/search', 'search')->name('search');
});


Route::prefix('handler')->name('handler.')->group(function() {

   // Route::get('/search_handler', [HomeController::class,'search_handler'])->name('search');
   Route::post('/subscribe', SubscribeController::class)->name('subscribe');
});


Route::controller(PostController::class)->prefix('post')
->name('post.')->group(function() {

   Route::get('/create', 'create')->name('create');
   Route::post('/{nano_id}', 'store')->name('store')->whereUlid('nano_id');
   Route::get('/{post}', 'show')->name('show')->whereUlid('post');
   Route::get('/{post}/edit', 'edit')->name('edit')->whereUlid('post');
   Route::get('/{post}/edit2', 'edit2')->name('edit2')->whereUlid('post');
   Route::patch('/{nano_id}', 'update')->name('update')->whereUlid('nano_id');
   Route::delete('/{nano_id}', 'destroy')->name('destroy')->whereUlid('nano_id');
});


Route::controller(TagController::class)->prefix('tag')
->name('tag.')->group(function() {

   Route::get('/create', 'create')->name('create');
   Route::post('/', 'store')->name('store');
   Route::delete('/{tag_id}', 'destroy')->name('destroy')->whereNumber('tag_id');
});


Route::controller(AdminController::class)->prefix('admin')
->name('admin.')->group(function() {

   Route::get('/{admin}', 'show')->name('show')->whereNumber('admin');
   Route::get('/{admin}/edit', 'edit')->name('edit')->whereNumber('admin');
   Route::patch('/{id}', 'update')->name('update')->whereNumber('id');
});


Route::controller(AuthController::class)->prefix('auth')
->name('auth.')->group(function() {

   Route::get('/login', 'login')->name('login');
   Route::get('/verify_email', 'verify_email')->name('verify_email');
   Route::get('/confirm_password', 'confirm_password')->name('confirm_password');
   Route::get('/change_password', 'change_password')->name('change_password');
   Route::get('/logout', 'logout')->name('logout');
   
   Route::prefix('handler')->name('handler.')->group(function() {
      
      Route::post('/login', 'login_handler')->name('login');
      Route::post('/verify_email', 'verify_email_handler')->name('verify_email');
      Route::post('/verify_passcode', 'verify_passcode')->name('verify_passcode');
      Route::post('/confirm_password', 'confirm_password_handler')->name('confirm_password');
      Route::post('/change_password', 'change_password_handler')->name('change_password');
   });
});


Route::resource('test', TestController::class);
