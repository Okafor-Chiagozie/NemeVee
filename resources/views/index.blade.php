@extends('header')
@inject('extra', 'App\Utils\Extra')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/index.css') }}">
   <link rel="stylesheet" href="{{ URL('css/index-responsive.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')
   <section class="section-1 outer">
      <section class="first-section">
         <h1>Where <span class="highlight">Ideas</span> flourish and <span class="highlight">minds</span> Ignite</h1>
         <section class="image-section">
            <img src="pictures/hero-image2.jpg" alt="Hero Image">
         </section>

      </section>

      <section class="second-section">
         <section class="heading">
            <h3>Editor's Picks</h3>
         </section>

         @isset($editor)   
            @if (count($editor) >= 1)
               <a href="{{ route('post.show', [$editor[0]->nano_id]) }}" class="other-section">
                  <section class="image-section">
                     <img src="{{ asset('storage/post_images/'.$editor[0]->image) }}" alt="{{ $editor[0]->title }}">
                  </section>

                  <section class="content-section">
                     <section class="date-section">
                        <span>{{ $editor[0]->published_at->format("d/m/Y") }}</span>
                        <span>{{ $extra->minuteRead($editor[0]->content) }} min read</span>
                     </section>

                     <h2 class="title">
                        {{ $editor[0]->title }}
                     </h2>

                     <p>
                        {{ $extra->remove_tags($editor[0]->content) }}
                     </p>

                     <section class="tag-section">
                        @foreach ($editor[0]->tags as $post_tags)
                           <span>{{ ucfirst($post_tags->name) }}</span>
                        @endforeach
                     </section>
                  </section>
               </a>
            @endif
         @endisset
         
         @isset($editor)   
            @if (count($editor) >= 2)
               <a href="{{ route('post.show', [$editor[1]->nano_id]) }}" class="other-section">
                  <section class="image-section">
                     <img src="{{ asset('storage/post_images/'.$editor[1]->image) }}" alt="{{ $editor[1]->title }}">
                  </section>

                  <section class="content-section">
                     <section class="date-section">
                        <span>{{ $editor[1]->published_at->format("d/m/Y") }}</span>
                        <span>{{ $extra->minuteRead($editor[1]->content) }} min read</span>
                     </section>

                     <h2 class="title">
                        {{ $editor[1]->title }}
                     </h2>

                     <p>
                        {{ $extra->remove_tags($editor[1]->content) }}
                     </p>

                     <section class="tag-section">
                        @foreach ($editor[1]->tags as $post_tags)
                           <span>{{ ucfirst($post_tags->name) }}</span>
                        @endforeach
                     </section>
                  </section>
               </a>
            @endif
         @endisset
      </section>
   </section>

   <section class="scroller-first outer">
      <section class="scroller-second">
         <section class="scroll-container">
            <span>Lifestyle</span>
            <i class="fa-solid fa-star"></i>
            <span>Growth</span>
            <i class="fa-solid fa-star"></i>
            <span>Mindset</span>
            <i class="fa-solid fa-star"></i>
            <span>Transformation</span>
            <i class="fa-solid fa-star"></i>
            <span>Ideas</span>
            <i class="fa-solid fa-star"></i>
            <span>Resilience</span>
            <i class="fa-solid fa-star"></i>
            <span>Development</span>
            <i class="fa-solid fa-star"></i>
            <span>Adventure</span>
            <i class="fa-solid fa-star"></i>
            <span>Innovation</span>
            <i class="fa-solid fa-star"></i>
            <span>Lifestyle</span>
            <i class="fa-solid fa-star"></i>
            <span>Growth</span>
            <i class="fa-solid fa-star"></i>
            <span>Mindset</span>
            <i class="fa-solid fa-star"></i>
            <span>Transformation</span>
            <i class="fa-solid fa-star"></i>
            <span>Ideas</span>
            <i class="fa-solid fa-star"></i>
            <span>Resilience</span>
            <i class="fa-solid fa-star"></i>
            <span>Development</span>
            <i class="fa-solid fa-star"></i>
            <span>Adventure</span>
            <i class="fa-solid fa-star"></i>
            <span>Innovation</span>
            <i class="fa-solid fa-star"></i>
         </section>
      </section>
   </section>

   <section class="blog-post-1 outer">
      <section class="heading">
         <h3>Most Recent</h3>
      </section>

      @isset($most_recent)
         @foreach ($most_recent as $post)
            <a href="{{ route('post.show', [$post->nano_id]) }}" class="post-section">
               <section class="image-section">
                  <img src="{{ asset('storage/post_images/'.$post->image) }}" alt="{{ $post->title }}">
               </section>
      
               <section class="content-section">
                  <section class="date-section">
                     <span>{{ $post->published_at->format("d/m/Y") }}</span>
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

         @empty($most_recent->toArray())
            <section class="nothing">
               <section class="image-section">
                  <img src="{{ URL('pictures/Hand holding pen-amico.svg') }}" alt="Coming up with something">
               </section>
               <p>Coming up with awesome ideas ...</p>
            </section>
         @endempty
      @endisset

      <section class="read-more">
         <a href="{{ route('home.category') }}">Read More <i class="fa-solid fa-arrow-right"></i></a>
      </section>
   </section>

   <section class="blog-post-2 outer">
      @isset($editor)   
         @if (count($editor) >= 3)
            <a href="{{ route('post.show', [$editor[2]->nano_id]) }}" class="post-section row-reverse">
               <section class="image-section">
                  <img src="{{ asset('storage/post_images/'.$editor[2]->image) }}" alt="{{ $editor[2]->title }}">
               </section>

               <section class="content-section">
                  <section class="date-section">
                     <span>{{ $editor[2]->published_at->format("d/m/Y") }}</span>
                     <span>{{ $extra->minuteRead($editor[2]->content) }} min read</span>
                  </section>

                  <h2 class="title">
                     {{ $editor[2]->title }}
                  </h2>

                  <p>
                     {{ $extra->remove_tags($editor[2]->content) }}
                  </p>

                  <section class="tag-section">
                     @foreach ($editor[2]->tags as $post_tags)
                        <span>{{ ucfirst($post_tags->name) }}</span>
                     @endforeach
                  </section>
               </section>
            </a>
         @endif
      @endisset
   </section>

   <section class="blog-post-1 outer">
      <section class="heading">
         <h3>Most Popular</h3>
      </section>

      @isset($most_popular)
         @foreach ($most_popular as $post)
            <a href="{{ route('post.show', [$post->nano_id]) }}" class="post-section">
               <section class="image-section">
                  <img src="{{ asset('storage/post_images/'.$post->image) }}" alt="{{ $post->title }}">
               </section>
      
               <section class="content-section">
                  <section class="date-section">
                     <span>{{ $post->published_at->format("d/m/Y") }}</span>
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

         @empty($most_popular->toArray())
            <section class="nothing">
               <section class="image-section">
                  <img src="{{ URL('pictures/Hand holding pen-amico.svg') }}" alt="Coming up with something">
               </section>
               <p>Coming up with awesome ideas ...</p>
            </section>
         @endempty
      @endisset

      <section class="read-more">
         <a href="{{ route('home.category') }}">Read More <i class="fa-solid fa-arrow-right"></i></a>
      </section>
   </section>

   <section class="blog-post-2 outer">
      @isset($editor)   
         @if (count($editor) >= 4)
            <a href="{{ route('post.show', [$editor[3]->nano_id]) }}" class="post-section row">
               <section class="image-section">
                  <img src="{{ asset('storage/post_images/'.$editor[3]->image) }}" alt="{{ $editor[3]->title }}">
               </section>

               <section class="content-section">
                  <section class="date-section">
                     <span>{{ $editor[3]->published_at->format("d/m/Y") }}</span>
                     <span>{{ $extra->minuteRead($editor[3]->content) }} min read</span>
                  </section>

                  <h2 class="title">
                     {{ $editor[3]->title }}
                  </h2>

                  <p>
                     {{ $extra->remove_tags($editor[3]->content) }}
                  </p>

                  <section class="tag-section">
                     @foreach ($editor[3]->tags as $post_tags)
                        <span>{{ ucfirst($post_tags->name) }}</span>
                     @endforeach
                  </section>
               </section>
            </a>
         @endif
      @endisset
   </section>
   
   <section class="blog-post-1 outer">
      <section class="heading">
         <h3>Others</h3>
      </section>

      @isset($others)
         @foreach ($others as $post)
            <a href="{{ route('post.show', [$post->nano_id]) }}" class="post-section">
               <section class="image-section">
                  <img src="{{ asset('storage/post_images/'.$post->image) }}" alt="{{ $post->title }}">
               </section>
      
               <section class="content-section">
                  <section class="date-section">
                     <span>{{ $post->published_at->format("d/m/Y") }}</span>
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

         @empty($others->toArray())
            <section class="nothing">
               <section class="image-section">
                  <img src="{{ URL('pictures/Hand holding pen-amico.svg') }}" alt="Coming up with something">
               </section>
               <p>Coming up with awesome ideas ...</p>
            </section>
         @endempty
      @endisset

      <section class="read-more">
         <a href="{{ route('home.category') }}">Read More <i class="fa-solid fa-arrow-right"></i></a>
      </section>
   </section>

   <section class="subscribe-section outer">
         <h2>Get our blog posts right in your inbox</h2>

         <form class="search-form" id="subscribe-form" method="post" action=""> 
            @csrf
            <input type="email" name="email" placeholder="Subscribe with your email" required>
            <button type="submit" id="email_submit"><i class="fa-solid fa-paper-plane"></i></button>
         </form>
   </section>
@endsection

@section('js_script')
   <script src="{{ URL('fmworks/jquery.js') }}"></script>
   <script src="{{ URL('fmworks/toastr.min.js') }}"></script>
   <script src="{{ URL('js/utils.js') }}"></script>
   <script src="{{ URL('js/index.js') }}"></script>
@endsection
      