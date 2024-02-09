@extends('header')
@inject('extra', 'App\Utils\Extra')

@section('title', 'Category - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/category.css') }}">
@endsection

@section('body_style')
   style="height: 100vh;"
@endsection

@section('body_content')
   <section class="heading">
      <h1>Our Categories</h1>
   </section>

   <section class="filter-section">
      <h3 class="title"><i class="fa-solid fa-sliders"></i> Filters</h3>

      <section class="filters">
         @auth('web')            
            <span class="toggle" id="toogle-section">
               <span>Draft</span>
               <span class="selected">Publish</span> 
               <span>Editor</span>
               <span>Normal</span>
            </span>
         @endauth
         
         <select class="form-select" id="form-select">
            <option value="all" selected>All</option>
            @isset($tags)
               @foreach ($tags as $tag)
                  <option value="{{ $tag->name }}">{{ ucfirst($tag->name) }}</option>
               @endforeach
            @endisset
         </select>
      </section>
   </section>

   <main class="category-items">
      @isset($posts)
         @foreach ($posts as $post)
            <a href="{{ route('post.show', [$post->nano_id]) }}" class="post-section {{ $post->type }}"
               data-attribute="@foreach ($post->tags as $post_tag){{ $post_tag->name.' ' }}@endforeach">
               <section class="image-section">
                  <img src="{{ asset('storage/post_images/'.$post->image) }}" alt="@isset($post){{ $post->title }}@endisset">
               </section>

               <section class="content-section">
                  <section class="date-section">
                     <span>@isset($post->published_at){{ $post->published_at->format("d/m/Y") }}@else draft @endisset</span>
                     <span>{{ $extra->minuteRead($post->content) }} min read</span>
                  </section>

                  <h2 class="title">
                     {{ $post->title }}
                  </h2>

                  <p>
                     {{ $extra->remove_tags($post->content) }}
                  </p>

                  <section class="tag-section">
                     @foreach ($post->tags as $post_tags)
                        <span>{{ ucfirst($post_tags->name) }}</span>
                     @endforeach
                  </section>
               </section>
            </a>
         @endforeach
      @endisset
   </main>
@endsection

@section('js_script')
   <script src="{{ URL('js/category.js') }}"></script>
   @auth('web')
      <script src="{{ URL('js/category2.js') }}"></script>      
   @endauth
@endsection