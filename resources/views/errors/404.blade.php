@extends('header')

@section('title', '404 - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/search.css') }}">

   <style>
      .main-section .heading>h1{
         color: transparent;
         background: linear-gradient(90deg, var(--main-white) 0% 40%, var(--main-grey));
         background-clip: text;
         -webkit-background-clip: text;
      }
   </style>
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Page not found</h1>
      </section>

      <section class="search-results">
         <section class="nothing-section">
            <section class="image-section">
               <img src="{{ URL('pictures/404 Error-amico.svg') }}" alt="Empty search result">
            </section>
   
            <h1>Oops!, 404 Error</h1>
         </section>
      </section>
   </main>
@endsection