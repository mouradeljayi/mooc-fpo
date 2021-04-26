<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <!-- Tailwind CSS -->
        <link href="/css/app.css" rel="stylesheet">

        <title>MOOC FPO</title>

        <style>
            * {
            margin: 0;
            padding: 0;
            }
            body {
                font-family: 'Lato', sans-serif;
            }
            .active{
                display: block;
            }
        </style>

    </head>

    <body class="bg-gray-200">
      <!-- Start Navigation -->
      @if(Auth::guard('professor')->check() || Auth::guard('web')->check() || Auth::guard('admin')->check())
      <div class="bg-white shadow fixed inset-x-0 top-0 z-20">
        <div class="container mx-auto py-2">
          <nav class="md:flex flex-row md:justify-between">
            <div class="flex flex-row justify-between">
              <a href="/"><img src="{{ asset('img/logo_fpo.png') }}" alt="logo_fpo" class="w-40"></a>
              <button id="hamburgerbtn" class="md:hidden focus:outline-none mr-3"> <i class="fas fa-bars fa-2x"></i> </button>
            </div>
            @if(Auth::guard('professor')->check())

            <ul class="hidden md:flex mt-4 md:mt-0 md:flex-row items-center" id="mobileMenu">
              <li class="pr-8 ml-4 md:ml-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('profHome') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-stream"></i> Mes Modules</a> </li>
              <li class="pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('discussions.index') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-comments"></i> Forum</a> </li>
              <li class="relative pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-green-500"> <a href="{{ route('profs.notifications') }}"><i class="fas fa-bell fa-lg"></i>@unless(Auth::guard('professor')->user()->unreadNotifications->isEmpty()) <span class="absolute bottom-3 left-3 rounded-full bg-red-500 text-white text-sm px-1">{{ Auth::guard('professor')->user()->unreadNotifications()->count() }}</span>@endunless</a> </li>
              <li class=" ml-4 md:ml-0 mt-4 md:mt-0" x-data="{ open:false }">
                <div class="flex items-center cursor-pointer relative" @click="open = true">
                  <span class="mr-2 font-semibold hover:text-gray-400">{{ Auth::guard('professor')->user()->name }}</span>
                  <img src="{{ asset('/files/avatars/' . Auth::guard('professor')->user()->avatar) }}" class="rounded-full w-11 h-11">
                  <ul x-show="open" @click.away="open = false" class="absolute p-2 bg-white shadow overflow-hidden rounded w-48 border mt-0 md:mt-2 top-12 md:right-0">
                    <li class="hover:bg-gray-200 p-2 font-semibold"> <a href="{{ route('profs.profile') }}"><i class="fas fa-user"></i> Profile</a> </li>
                    <li  class="hover:bg-gray-200 p-2 font-semibold"> <a href="{{ route('profLogout') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a> </li>
                  </ul>
                </div>
              </li>
            </ul>

            @elseif(Auth::guard('web')->check())

            <ul class="hidden md:flex mt-4 md:mt-0 md:flex-row items-center" id="mobileMenu">
              <li class="pr-8 ml-4 md:ml-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('studentHome') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-graduation-cap"></i> Mes Cours</a> </li>
              <li class="pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('discussions.index') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-comments"></i> Forum</a> </li>
              <li class="relative pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-green-500"> <a href="{{ route('users.notifications') }}"><i class="fas fa-bell fa-lg"></i>@unless(auth()->user()->unreadNotifications->isEmpty()) <span class="absolute bottom-3 left-3 rounded-full bg-red-500 text-white text-sm px-1">{{ auth()->user()->unreadNotifications->count() }}</span> @endunless</a> </li>
              <li class=" ml-4 md:ml-0 mt-4 md:mt-0" x-data="{ open:false }">
                <div class="flex items-center cursor-pointer relative" @click="open = true">
                  <span class="mr-2 font-semibold hover:text-gray-400">{{ Auth::guard('web')->user()->name }}</span>
                  <img src="{{ asset('/files/avatars/' . Auth::guard('web')->user()->avatar) }}" class="rounded-full w-11 h-11">
                  <ul x-show="open" @click.away="open = false" class="absolute p-2 bg-white shadow overflow-hidden rounded w-48 border mt-0 md:mt-2 top-12 md:right-0">
                    <li class="hover:bg-gray-200 p-2 font-semibold"> <a href="{{ route('users.profile') }}"><i class="fas fa-user"></i> Profile</a> </li>
                    <li  class="hover:bg-gray-200 p-2 font-semibold"> <a href="{{ route('studentLogout') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a> </li>
                  </ul>
                </div>
              </li>
            </ul>

            @elseif(Auth::guard('admin')->check())

            <ul class="hidden md:flex mt-4 md:mt-0 md:flex-row items-center" id="mobileMenu">
              <li class="pr-8 ml-4 md:ml-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('admin.dashboard') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-spinner"></i> Statestics</a> </li>
              <li class="pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('admin.users') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-user-graduate"></i> Etudiants</a> </li>
              <li class="pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('admin.profs') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-user-tie"></i> Professeurs</a> </li>
              <li class="pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('admin.filieres') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-paperclip"></i> Filières</a> </li>
              <li class="pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-white"> <a href="{{ route('admin.modules') }}" class="bg-green-500 rounded-full pl-2 pr-2 pb-1 pt-1"><i class="fas fa-stream"></i> Modules</a> </li>
              <li class="relative pr-8 ml-4 md:ml-0 mt-4 md:mt-0 text-lg text-gray-800 font-semibold uppercase hover:text-green-500"> <a href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt fa-lg"></i> Déconnexion</a> </li>

            </ul>

            @endif

          </nav>
        </div>
      </div>
      @endif


      <!-- End Navigation -->


      @yield('content')


      <!-- JAVASCRIPT -->

      <script>
          // start hamburger menu script
          let hamburger = document.getElementById('hamburgerbtn');

          let mobileMenu = document.getElementById('mobileMenu');

          hamburger.addEventListener('click', function(){
              mobileMenu.classList.toggle('active');
          });
          // end hamburger menu script

          // start upload file name label script
          const actualBtn = document.querySelector('.actual-btn');

          const fileChosen = document.querySelector('.file-chosen');

          actualBtn.addEventListener('change', function(){
            fileChosen.textContent = this.files[0].name
          });

          const actualBtn2 = document.querySelector('.actual-btn2');

          const fileChosen2 = document.querySelector('.file-chosen2');

          actualBtn2.addEventListener('change', function(){
            fileChosen2.textContent = this.files[0].name
          });
          // end upload file name label script

      </script>
      <!-- Alpine JS -->
      <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </body>
</html>
