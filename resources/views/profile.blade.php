@extends('header')

@section('title', 'Profile - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/profile.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Profile</h1>
      </section>

      <section class="main-content">
         <section class="main-form" id="main-form">
            <section class="title">
               <h3>Profile</h3>
            </section>

            <section class="form-input">
               <label for="username">Username</label>
               <span class="data-span">@isset($admin){{ $admin->username }}@endisset</span>
            </section>
            
            <section class="form-input">
               <label for="email">Email</label>
               <span class="data-span">@isset($admin){{ $admin->email }}@endisset</span>
            </section>

            <section class="form-input">
               <a href="{{ route('admin.edit', [$admin->id]) }}">Edit <i class="fas fa-edit"></i></a>
            </section>
         </section>

         {{-- <section class="category">
            <section class="title">
               <h3>Available Category</h3>
            </section>

            <section class="form-input" id="tag-section">
               
            </section>
         </section> --}}
      </section>

   </main>
@endsection
