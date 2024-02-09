@extends('header')

@section('title', 'Confirm Password - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/edit-profile.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Confirm Password</h1>
      </section>
      
      <section class="main-content">
         <form method="post" action="{{ route('auth.handler.confirm_password') }}" class="main-form" id="main-form">
            @csrf
            <section class="title">
               <h3>Confirm Password</h3>
            </section>
            
            <p class=""><i class="fa-solid fa-circle-info"></i> Please confirm your password to continue</p>
            
            <section class="form-input">
               <label for="password">Password</label>
               <input type="password" min="8" max="70" placeholder="Password" name="password" required>
            </section>
            
            <section class="form-input">
               <button type="submit">Confirm <i class="fas fa-sign-in"></i></button>
            </section>
         </form>
      </section>

   </main>
@endsection

@section('js_script')
   <script src="{{ URL('fmworks/jquery.js') }}"></script>
   <script src="{{ URL('fmworks/toastr.min.js') }}"></script>
   @if ($errors->any())
      @foreach ($errors->all() as $error)
         <script>toastr.error('{{ $error }}', 'Publish Error', {timeOut: 5000});</script>
      @endforeach
   @endif
@endsection