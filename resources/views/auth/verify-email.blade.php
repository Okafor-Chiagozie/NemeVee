@extends('header')

@section('title', 'Verify Email - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/edit-profile.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Verify Email</h1>
      </section>

      <section class="main-content">
         <form method="post" action="" class="main-form" id="verify-email-form">
            @csrf
            <section class="title">
               <h3>Verify Email</h3>
            </section>
            
            <section class="form-input">
               <label for="email">Email</label>
               <input type="email" max="100" placeholder="Email" name="email" value="" required>
               <a href="{{ route('auth.login') }}">← Back</a>
            </section>
            
            <section class="form-input">
               <button type="submit">
                  Verify <i class="fas fa-sign-in"></i> 
                  <span class="button-loader" id="button-loader"> <span></span> </span> 
               </button>
            </section>
         </form>
      </section>

   </main>
@endsection

@section('js_script')
   <script src="{{ URL('fmworks/jquery.js') }}"></script>
   <script src="{{ URL('fmworks/toastr.min.js') }}"></script>
   <script src="{{ URL('js/utils.js') }}"></script>
   <script src="{{ URL('js/verify-email.js') }}"></script>
@endsection