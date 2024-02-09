@extends('header')

@section('title', 'Edit Profile - ')

@section('css_script')
   <link rel="stylesheet" href="{{ URL('css/edit-profile.css') }}">
   <link rel="stylesheet" href="{{ URL('fmworks/toastr.css') }}">
@endsection

@section('body_content')
   <main class="main-section">
      <section class="heading">
         <h1>Edit Profile</h1>
      </section>

      <section class="main-content">
         <form method="post" action="{{ route('admin.update', [$admin->id]) }}" class="main-form" id="main-form">
            @csrf
            @method('PATCH')
            <section class="title">
               <h3>Edit Profile</h3>
            </section>

            <section class="form-input">
               <label for="username">Username</label>
               <input type="text" max="100" placeholder="Username" name="username" 
               value="@isset($admin){{ $admin->username }}@endisset">
            </section>
            
            <section class="form-input">
               <label for="email">Email</label>
               <input type="email" max="100" placeholder="Email" name="email" 
               value="@isset($admin){{ $admin->email }}@endisset">
            </section>

            <section class="form-input">
               <button type="submit">Update <i class="fa-solid fa-arrow-up"></i></button>
            </section>
         </form>

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

@section('js_script')
   <script src="{{ URL('fmworks/jquery.js') }}"></script>
   <script src="{{ URL('fmworks/toastr.min.js') }}"></script>
   @if ($errors->any())
      @foreach ($errors->all() as $error)
         <script>toastr.error('{{ $error }}', 'Publish Error', {timeOut: 50000});</script>
      @endforeach
   @endif
@endsection