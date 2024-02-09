@extends('header')
@inject('extra', 'App\Utils\Extra')

@section('meta')
   <meta property="og:image" content="@isset($post){{ asset('storage/post_images/'.$post->image) }}@endisset">
   <meta property="og:image" content="image/{{ explode('.', $post->image)[1] ?? 'jpeg' }}">
   <meta property="og:type" content="article">
   <meta property="og:title" content="@isset($post){{ $post->title }}@endisset">
   <meta property="og:description" content="@isset($post){{ mb_substr($extra->remove_tags($post->content), 0, 200)."..." }}@endisset">
@endsection

@section('title', ($post->title ?? 'Blog').' -' )

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/blog-post.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')
@inject('extra', 'App\Utils\Extra')
<main class="main-section">
   <section class="blog-post">
      <section class="heading">
         <section class="date-section">
            <span>@isset($post)@isset($post->published_at){{ $post->published_at->format("d/m/Y") }}@else draft @endisset @endisset</span>
            <span>@isset($post){{ $extra->minuteRead($post->content) }}@endisset min read</span>
         </section>
         <h1 class="title" id="post-title">@isset($post){{ $post->title }}@endisset</h1>

         <section class="interact-section">
            <section class="interactions">
               <span class="interact-icon" title="Views"><i class="fas fa-eye"></i> @isset($post){{ $post->views }}@endisset</span>
               <span class="interact-icon" title="Likes"><i class="fas fa-thumbs-up"></i> @isset($post){{ ceil($post->views/2) }}@endisset</span>
               <span class="interact-icon share-icon" id="share-icon" title="Share"><i class="fas fa-share-alt"></i></span>
            </section>
   
            @auth('web')
               <section class="interactions">
                  <a href="{{ route('post.edit', [$post->nano_id]) }}" class="interact-icon" id="admin"><i class="fas fa-edit" style="color: yellowgreen;"></i> Edit</a>
                  @csrf
                  <span class="interact-icon" id="admin" onclick="deletePost('{{ $post->nano_id }}')"><i class="fa-solid fa-trash" style="color: red;"></i> Delete</span>
               </section>
            @endauth
         </section>
         
      </section>

      <section class="post-content">
         <section class="image-section">
            <img src="@isset($post){{ asset('storage/post_images/'.$post->image) }}@endisset" alt="@isset($post){{ $post->title }}@endisset">
         </section>

         @isset($post){!! $post->content !!}@endisset
      </section>

      <section class="tag-section">
         @isset($post)
            @foreach ($post->tags as $post_tags)
               <span>{{ ucfirst($post_tags->name) }}</span>
            @endforeach
         @endisset
      </section>

      <section class="interactions">
         <span title="Views"><i class="fas fa-eye"></i> @isset($post){{ $post->views }}@endisset</span>
         <span title="Likes"><i class="fas fa-thumbs-up"></i> @isset($post){{ ceil($post->views/2) }}@endisset</span>
         <span class="share-icon" id="share-icon" title="Share"><i class="fas fa-share-alt"></i></span>
      </section>
   </section>

   <section class="related-post">
      <section class="heading">
         <h3>Related Posts</h3>
      </section>

      @isset($related_posts)
         @foreach ($related_posts as $related_post)
            <a href="{{ route("post.show", [$related_post->nano_id]) }}" class="post-section">
               <section class="image-section">
                  <img src="{{ asset('storage/post_images/'.$post->image) }}" alt="Blog Image">
               </section>
      
               <section class="content-section">
                  <section class="date-section">
                     <span>@isset($related_post->published_at){{ $related_post->published_at->format("d/m/Y") }}@else draft @endisset</span>
                     <span>{{ $extra->minuteRead($related_post->content) }} min read</span>
                  </section>
      
                  <h2 class="title">
                     @isset($post){{ $related_post->title }}@endisset
                  </h2>
      
                  <p>
                     @isset($post){{ $extra->remove_tags($related_post->content) }}@endisset
                  </p>
      
                  <section class="tag-section">
                     @foreach ($related_post->tags as $post_tags)
                        <span>{{ ucfirst($post_tags->name) }}</span>
                     @endforeach
                  </section>
               </section>
            </a>
         @endforeach

         @empty($related_posts->toArray())
            <section class="nothing">
               <section class="image-section">
                  <img src="{{ URL('pictures/Hand holding pen-amico.svg') }}" alt="Coming up with something">
               </section>
               <p>Coming up with interesting ideas ...</p>
            </section>
         @endempty
      @endisset

   </section>
</main>
@endsection

@section('js_script')
   <script src="{{ URL('fmworks/jquery.js') }}"></script>
   <script src="{{ URL('fmworks/toastr.min.js') }}"></script>
   <script src="{{ URL('js/utils.js') }}"></script>
   <script src="{{ URL('js/blog-post.js') }}"></script>
@endsection