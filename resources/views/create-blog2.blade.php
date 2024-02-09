@extends('header')
@inject('extra', 'App\Utils\Extra')

@section('title', 'Create Post - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/create-blog2.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')

   <main class="main-section">
      <section class="heading">
         <h1>Finalize your work</h1>
      </section>

      <section class="post-container">
         <a href="{{ route('post.edit', [$post->nano_id]) }}" class="post-section row-reverse">
            <section class="image-section">
               <img src="@isset($post){{ asset('storage/post_images/'.$post->image) }}@endisset" alt="@isset($post){{ $post->title }}@endisset">
            </section>
            {{-- @isset($post){{ URL('pictures/'.$post->image) }}@endisset --}}
            {{-- {{ Storage::disk('post_images')->url($post->image) }} --}}

            <section class="content-section">
               <section class="date-section">
                  <span>@isset($post)@isset($post->published_at){{ $post->published_at->format("d/m/Y") }}@else draft @endisset @endisset</span>
                  <span>@isset($post){{ $extra->minuteRead($post->content) }}@endisset min read</span>
               </section>

               <h2 class="title">@isset($post){{ $post->title }}@endisset</h2>

               <p>@isset($post){{ $extra->remove_tags($post->content) }}@endisset</p>
            </section>
         </a>
      </section>

      <form action="{{ route('post.store', [$post->nano_id]) }}" method="post" 
         enctype="multipart/form-data" class="first-form">
         @csrf
         <section class="image-section">
            <section class="title">
               <h3>Image</h3>
            </section>
            
            <section class="first-section">
               <input type="file" name="image">
            </section>
         </section>
         
         <section class="type-section">
            <section class="title">
               <h3>Type</h3>
            </section>
            
            <section class="first-section">
               <span><input type="radio" name="type" value="editor" @isset($post)@checked($post->type == 'editor')@endisset> Editor's choice</span>
               <span><input type="radio" name="type" value="normal" @isset($post)@checked($post->type == 'normal')@endisset> Normal</span>
            </section>
         </section>
   
         <section class="tags-section">
            <section class="title">
               <h3>Tags</h3>
            </section>
            
            <section class="first-section">
               @isset($tags)
                  @foreach ($tags as $tag)
                     <span><input type="checkbox" name="tags[]" @checked(in_array($tag->id, $post_tags)) 
                        value="{{ $tag->id }}"> {{ ucfirst($tag->name) }}</span>
                  @endforeach
               @endisset
            </section>
         </section>
   
         <section class="button-section">
            <button name="publish" value="draft">Draft</button>
            <button name="publish" value="publish">Publish</button>
         </section>
      </form>
   </main>
@endsection

@section('js_script')
   <script src="{{ URL('fmworks/jquery.js') }}"></script>
   <script src="{{ URL('fmworks/toastr.min.js') }}"></script>

   @if ($errors->any())
      @foreach ($errors->all() as $error)
         <script>toastr.error('{{ $error }}', 'Publish Error', {timeOut: 50000});</script>
      @endforeach
   @endif
@endsection