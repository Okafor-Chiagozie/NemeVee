<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Mail\PostMail;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
   public function __construct()
   {
      $this->middleware(['auth:web'])->except(['update', 'show']);
   }

   /**
    * Show the form for creating a new resource
    *
    * @return mixed
    */
   public function create(): mixed
   {
      $new_blog_post = Post::create(['nano_id' => (string) Str::ulid()]);

      return to_route('post.edit', [$new_blog_post->nano_id]);
   }
    
   /**
    * Show the form for editing the specified resource
    *
    * @param \App\Models\Post $post
    * @return mixed
    */
   public function edit(Post $post) :mixed
   {
      $edit_page = true;

      return view('create-blog', compact('post', 'edit_page'));
   }
   
   /**
    * Update the specified resource in storage
    *
    * @param \App\Http\Requests\Post\UpdatePostRequest $request
    * @param string $nano_id
    * @return mixed
    */
   public function update(UpdatePostRequest $request, string $nano_id) :mixed
   {
      $validated = $request->validated();
      Post::where('nano_id', $nano_id)->update($validated);

      return response()->json(['message' => 'Saved successfully']);
   }
     
   /**
    * Display a specified resource
    *
    * @param \App\Models\Post $post
    * @return mixed
    */
   public function show(Post $post) :mixed
   {
      $post->load('tags');

      session()->put('related_ids', array_column($post->tags->toArray(), 'id'));

      $related_posts = Post::whereNot('id', $post->id)->whereNotNull('published_at')
      ->with('related_tags')->has('related_tags')->limit(3);
      
      if(auth()->user())
         $related_posts = Post::whereNot('id', $post->id)->latest('published_at')
      ->latest('updated_at')->with('related_tags')->has('related_tags')->limit(3);
      
      $related_posts = $related_posts->get();

      if($post->published_at)
         $post->increment('views');

      if(request()->expectsJson())
         return response()->json(['message' => $post]);

      return view('blog-post', compact('post', 'related_posts'));
      // Mail::to('collincity111@gmail.com')->send(new PostMail($post->title, $post->content));
      // return new PostMail($post->title, $post->content);
   }
   
   /**
    * Show the second form for editing the specified resource
    *
    * @param \App\Models\Post $post
    * @return mixed
    */
   public function edit2(Post $post) :mixed
   {
      $post->load('tags');

      $post_tags = [];
      foreach($post->tags as $post_tag)
         array_push($post_tags, $post_tag->id);
      
      return view('create-blog2', compact('post', 'post_tags'));
   }
   
   /**
    * Publish a resource
    *
    * @param \App\Http\Requests\Post\PublishPostRequest $request
    * @param string $nano_id
    * @return mixed
    */
   public function store(StorePostRequest $request, string $nano_id) :mixed
   {
      $current_post = Post::where('nano_id', $nano_id);
      $sub_array = $request->safe()->except('tags');

      if(request()->has('image')){
         if($current_post->value('image') != 'default.jfif')
            Storage::disk('post_images')->delete($current_post->value('image'));

         $image_extension = $request->image->getClientOriginalExtension();
         $image_name = (string) Str::ulid().'.'.$image_extension;
         $request->image->storeAs('public/post_images', $image_name);
         $sub_array['image'] = $image_name;
      }
      
      if(request()->publish == 'publish')
         $sub_array = array_merge($sub_array, ['published_at' => (string) now()]);


      $current_post->update($sub_array);
      $current_post->first()->tags()->sync($request->validated()['tags']);     

      return to_route('post.show', [$nano_id]);
   }
   
   /**
    * Remove the specified resource from storage.
    *
    * @param string $nano_id
    * @return mixed
    */
   public function destroy(string $nano_id) :mixed
   {
      Post::where('nano_id', $nano_id)->forceDelete();

      if(request()->expectsJson())
         return response()->json(['message' => route('home.category')]);

      return to_route('home.category');
   }
   
}
