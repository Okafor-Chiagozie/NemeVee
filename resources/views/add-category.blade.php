@extends('header')

@section('title', 'Add Category - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/add-category.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Add Category</h1>
      </section>

      <section class="main-content">
         <form action="post" action="" class="add-form" id="add-form">
            @csrf
            <section class="title">
               <h3>Add Category</h3>
            </section>

            <section class="first-section">
               <input type="text" max="30" placeholder="Category name" name="name">
               <button>Add <span>+</span></button>
            </section>
         </form>

         <section class="category">
            <section class="title">
               <h3>Available Category</h3>
            </section>

            <section class="first-section" id="tag-section">
               {{-- <span>Something <span>x</span></span> --}}
            </section>
         </section>
      </section>

   </main>
@endsection

@section('js_script')
   <script src="{{ URL('fmworks/jquery.js') }}"></script>
   <script src="{{ URL('fmworks/toastr.min.js') }}"></script>
   <script src="{{ URL('js/utils.js') }}"></script>
   <script src="{{ URL('js/add-category.js') }}"></script>
@endsection