@extends('header')

@section('title', 'Login - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/edit-profile.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Login</h1>
      </section>

      <section class="main-content">
         <form method="post" action="{{ route('auth.handler.login') }}" class="main-form" id="main-form">
            @csrf
            <section class="title">
               <h3>Login</h3>
            </section>
            
            <section class="form-input">
               <label for="email">Email</label>
               <input type="email" max="100" placeholder="Email" name="email" value="{{ old('email') }}" required>
            </section>

            <section class="form-input">
               <label for="password">Password</label>
               <input type="password" min="8" max="70" placeholder="Password" name="password" required>
               <a href="{{ route('auth.verify_email') }}">Forgot Password?</a>
            </section>
            
            <section class="form-input">
               <button type="submit">Login <i class="fas fa-sign-in"></i></button>
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