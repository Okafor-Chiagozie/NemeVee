@extends('header')

@section('title', 'Create Post - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/create-blog.css') }}">
   <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
   <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
@endsection

@section('body_style')
   style="height: 100vh;" onload='populate_editor("{{ request()->route('post')->nano_id }}")'
@endsection

@section('body_content')
   <section class="heading">
      <h1>Create Post</h1>
      <section class="interact-section"><a href="{{ route('post.show', [request()->route('post')->nano_id]) }}"><i class="fas fa-eye"></i> View Post</a></section>
   </section>

   <div class="post-title" id="post-title" spellcheck="false" placeholder="Title:" contenteditable="true"
   >@isset($post){{ $post->title }}@endisset</div>

   @csrf
   <section class="tools-section" id="tools-section">
      <button class="ql-bold"></button>
      <button class="ql-italic"></button>
      <button class="ql-underline"></button>
      <button class="ql-strike"></button>
      <button class="ql-link"></button>
      <select class="ql-size">
         <option value="small"></option>
         <option selected></option>
         <option value="large"></option>
      </select>
      <button class="ql-script" value="super"></button>
      <button class="ql-script" value="sub"></button>
      <button class="ql-list" value="ordered"></button>
      <button class="ql-list" value="bullet"></button>
      {{-- <button class="ql-image"></button> --}}
      <button class="ql-video"></button>
      <button class="ql-undo"><i class="fas fa-undo"></i></button>
      <button class="ql-redo"><i class="fas fa-redo"></i></button>
      {{-- <button class="ql-image-custom"><i class="fa-solid fa-image"></i></button> --}}
      <button class="ql-clean"></button>
      <button class="ql-save-indicator">Saving...</button>
   </section>

   <div class="post-body" id="post-body" spellcheck="false"></div>
@endsection

@section('js_script')
   <script src="{{ URL('js/utils.js') }}"></script>
   <script src="{{ URL('js/create-blog-post.js') }}"></script>
@endsection