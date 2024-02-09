@extends('header')

@section('title', 'About - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/about.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>About Us</h1>
      </section>

      <section class="main-content">
         <section class="image-section">
            <img src="{{ URL('pictures/hero-image2.jpg') }}" alt="About Image">
         </section>

         <p class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla iusto est quos 
            magni. Ab odio doloribus officiis optio neque, esse facere molestias non 
            distinctio ex unde, nulla incidunt et corrupti.
         </p>

         <p class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla iusto est quos 
            magni. Ab odio doloribus officiis optio neque, esse facere molestias non 
            distinctio ex unde, nulla incidunt et corrupti.
         </p>

         <p class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla iusto est quos 
            magni. Ab odio doloribus officiis optio neque, esse facere molestias non 
            distinctio ex unde, nulla incidunt et corrupti.
         </p>      
      </section>
   </main>
@endsection