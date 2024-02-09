@extends('header')
@inject('extra', 'App\Utils\Extra')

@section('title', 'Search - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/search.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Result for <span class="search-word">{{ ucfirst(request()->q) }}</span></h1>
         <section class="search-number">
            <span>Search results (@isset($post_number){{ $post_number }}@endisset)</span>
         </section>
      </section>

      <section class="search-results">
         @isset($posts)
            @foreach ($posts as $post)
               <a href="{{ route('post.show', [$post->nano_id]) }}" class="post-section row-reverse">
                  <section class="image-section">
                     <img src="{{ asset('storage/post_images/'.$post->image) }}" alt="{{ $post->title }}">
                  </section>
      
                  <section class="content-section">
                     <section class="date-section">
                        <span>@isset($post->published_at){{ $post->published_at->format("d/m/Y") }}@else draft @endisset</span>
                        <span>{{ $extra->minuteRead($post->content) }} min read</span>
                     </section>
      
                     <h2 class="title">{{ $post->title }}</h2>
      
                     <p>
                        {{ $extra->remove_tags($post->content) }}
                     </p>
      
                     <section class="tag-section">
                        @foreach ($post->tags as $post_tags)
                           <span>{{ $post_tags->name }}</span>
                        @endforeach
                     </section>
                  </section>
               </a>
            @endforeach

            @empty($posts->toArray())
               <section class="nothing-section">
                  <section class="image-section">
                     <img src="{{ URL('pictures/File searching-amico.svg') }}" alt="Empty search result">
                  </section>

                  <h2>Oops!, nothing found</h2>
               </section>
            @endempty
         @endisset
      </section>
   </main>
@endsection