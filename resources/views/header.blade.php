<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <link rel="shortcut icon" href="{{ URL('pictures/logo.svg') }}">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="keyword" content="">

      @section('meta')
         <meta property="og:image" content="{{ URL('pictures/logo.png') }}">
         <meta property="og:image" content="image/jpeg">
         <meta property="og:type" content="website">
         <meta property="og:title" content="NemeVee">
         <meta property="og:description" content="Where ideas flourish and minds ignite">
      @show

      <title>@yield('title') {{ env('APP_NAME') }}</title>

      @yield('css_script')

      <link rel="stylesheet" href="{{ URL('fontawesome-free-6.4.2-web/css/all.css') }}">
      <link rel="stylesheet" href="{{ URL('css/header-and-footer.css') }}">
      <link rel="stylesheet" href="{{ URL('css/font-responsiveness.css') }}">
   </head>

   <body @yield('body_style')>
      <header class="main-header">
         <section class="logo-section">
            <span class="hambuger-section" id="hambuger-section">
               <i class="fa-solid fa-bars"></i>
            </span>
            
            <a href="{{ route('home.index') }}" class="logo-container">
               <img src="{{ URL('pictures/logo.svg') }}" alt="Company Logo">
            </a>
         </section>

         <ul class="nav-section" id="nav-section">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('home.about') }}">About</a></li>
            <li><a href="{{ route('home.category') }}">Categories <i class="fa-solid fa-angle-up"></i></a>                  
               @isset($tags)
                  <section>
                     @foreach ($tags as $tag)
                     <a href="{{ route('home.category', [$tag->name]) }}">{{ ucfirst($tag->name) }}</a>
                     @endforeach
                  </section>
               @endisset
            </li>
         </ul>

         <section class="others">
            <span class="icon" id="search-icon"><i class="fas fa-search"></i></span>
            @auth('web')
               <span class="icon" id="profile-icon"><i class="fas fa-user"></i></span>
            @endauth
            @guest()
               <a href="mailto:collincity111@gmail.com">Contact Us</a>
            @endguest
            @auth('web')
               @isset($edit_page)
                  <a href="{{ route('post.edit2', [request()->route('post')->nano_id]) }}">Publish &nbsp;&nbsp;<i class="fa-solid fa-upload"></i></a>
               @else
                  <a href="{{ route('post.create') }}">New Post <span>+</span></a>
               @endisset
            @endauth
         </section>
      </header>

      @auth('web')
         <section class="admin-menu" id="admin-menu">
            <span class="menu-item"><a href="{{ route('post.create') }}"><i class="fa-solid fa-plus"></i> New Post</a></span>
            <span class="menu-item"><a href="{{ route('tag.create') }}"><i class="fas fa-align-left"></i> Add Category</a></span>
            <span class="menu-item"><a href="{{ route('admin.show', [auth()->user()->id]) }}"><i class="fas fa-user"></i> Profile</a></span>
            {{-- <span class="menu-item"><a href="{{ route('admin.edit', [auth()->user()->id]) }}"><i class="fas fa-edit"></i> Edit Profile</a></span> --}}
            <span class="menu-item"><a href="{{ route('auth.confirm_password') }}"><i class="fas fa-edit"></i> Change Password</a></span>
            <span class="menu-item"><a href="{{ route('auth.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></span>
         </section>
      @endauth
      
      <section class="search-form-section" id="search-form-section">
         <form class="search-form" method="get" action="{{ route('home.search') }}">
            <input type="search" placeholder="Search for anything: Lifestyle, Faith, Electrical Engineering" name="q" max="255" autocomplete required>
            <button type="submit"><i class="fas fa-search"></i></button>
         </form>
      </section>

      <dialog class="modal-box" id="modal-box">
         <h3 class="title">Confirm Action</h3>
         <p class="message">
            Are you sure you want to delete the selected item?
         </p>
         <section class="button-section">
            <button class="modal-button-no" id="modal-button-no">Cancel</button>
            <button class="modal-button-yes" id="modal-button-yes">Delete</button>
         </section>
      </dialog>

      <dialog class="modal-box" id="modal-box-passcode">
         <h3 class="title">Enter Passcode</h3>
         <section class="input-section">
            <input type="text" maxlength="4" minlength="4" placeholder="####">
            <p id="modal-info-passcode"><i class="fa-solid fa-circle-info"></i> Check your email inbox or spam for the passcode</p>
            <p>Resend</p>
         </section>
         <section class="button-section">
            <button class="modal-button-no" id="modal-button-passcode-no">Cancel</button>
            <button class="modal-button-yes" id="modal-button-passcode-yes">Verify</button>
         </section>
      </dialog>

      <a name="top"></a>
      <a href="#top" class="to-top-button" id="to-top-button"><i class="fa-solid fa-arrow-up"></i></a>


      @yield('body_content')


      <footer class="main-footer">
         <section class="logo-section">
            <a href="{{ route('home.index') }}" class="logo-container">
               <img src="{{ URL('pictures/logo.svg') }}" alt="Company Logo">
            </a>
         </section>

         <section class="others">
            <section class="summary-section">
               <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos rem veritatis 
                  dolore culpa unde reprehenderit ipsam minima, odit asperiores vero tempora, 
                  impedit omnis sapiente architecto similique quidem rerum vel quasi.
               </p>
            </section>

            <section class="link-section">
               <h3>Useful Links</h3>
               <a href="{{ route('home.index') }}">Home</a>
               <a href="{{ route('home.about') }}">About</a>
               <a href="mailto:collincity111@gmail.com">Contact Us</a>
               <a href="{{ route('home.category') }}">Categories</a>
            </section>

            <section class="media-section">
               <h3>Follow Us</h3>
               <a href="">
                  <i class="fa-brands fa-facebook"></i>
               </a>
   
               <a href="">
                  <i class="fa-brands fa-instagram"></i>
               </a>
   
               <a href="">
                  <i class="fa-brands fa-youtube"></i>
               </a>
   
               <a href="">
                  <i class="fa-brands fa-twitter"></i>
               </a>
            </section>
         </section>

         <section class="copyright-section">
            <span>Copyright © {{ now()->format('Y') }} NemeVee.</span>
         </section>

      </footer>

      <script src="{{ URL('js/modal-box.js') }}"></script>
      @yield('js_script')
      <script src="{{ URL('js/header.js') }}"></script>
      <script src="{{ URL('js/to-top.js') }}"></script>         
      @auth('web')
         <script src="{{ URL('js/header2.js') }}"></script>
      @endauth
   </body>
</html>
