<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\SearchRequest;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
   /**
    * Return the home page
    *
    * @return mixed
    */
   public function index(): mixed
   {
      $editor = Post::whereNotNull('published_at')
      ->where('type', 'editor')->latest('published_at')->limit(4)->get();

      $most_recent = Post::whereNotNull('published_at')->whereNot('type', 'editor')
      ->latest('published_at')->limit(3)->get();

      $most_popular = Post::whereNotNull('published_at')->whereNotIn('id', array_column($most_recent->toArray(), 'id'))
      ->whereNot('type', 'editor')->latest('views')->limit(3)->get();

      $except_ids = array_unique(array_merge(array_column($most_popular->toArray(), 'id'), array_column($most_recent->toArray(), 'id')));
      $others = Post::whereNotNull('published_at')->whereNot('type', 'editor')->whereNotIn('id', $except_ids)
      ->inRandomOrder()->limit(3)->get();

      return view('index', compact('editor', 'most_popular', 'most_recent', 'others'));
   }

   /**
    * Return the about page
    *
    * @return mixed
    */
   public function about(): mixed
   {
      return view('about');
   }

   /**
    * Return the category page
    *
    * @param null|string $category
    * @return mixed
    */
   public function category(?string $category = null): mixed
   {
      $posts = Post::whereNotNull('published_at')->with('tags')->latest('published_at');

      if(auth()->user())
         $posts = Post::with('tags')->latest('published_at')->latest('updated_at');

      $posts = $posts->get();

      return view('category', compact('posts'));
   }

   /**
    * Return the search page
    *
    * @param \App\Http\Requests\Home\SearchRequest $request
    * @return mixed
    */
   public function search(SearchRequest $request): mixed
   {
      $search_word = $request->validated()['q'];
      
      $post_number = Post::whereNotNull('published_at')->where('title', 'like', "%$search_word%")->with('tags');
      $posts = Post::whereNotNull('published_at')->where('title', 'like', "%$search_word%")->latest('published_at')
      ->latest('updated_at')->with('tags');
      
      if(auth()->user()){
         $post_number = Post::where('title', 'like', "%$search_word%")->with('tags');
         $posts = Post::where('title', 'like', "%$search_word%")->latest('published_at')
         ->latest('updated_at')->with('tags');
      }

      $post_number = $post_number->count();
      $posts = $posts->get();

      return view('search', compact('post_number', 'posts'));
   }

}
