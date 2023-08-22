<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'TALC') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  
  @if( env('TALC_MATOMO', false) )
    <x-matomo :container="env('MATOMO_CONTAINER_URL')" />
  @endif
</head>
<body class="font-sans antialiased bg-gray-50">

  <div class="relative bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
        <div class="lg:w-0 lg:flex-1">
          <a href="{{ route('web.home') }}" class="text-2xl font-bold">TALC</a>
        </div>
        <nav class="hidden md:flex space-x-10">

          @foreach( $menu as $menupage )

            <a href="{{ route('web.page', $menupage) }}" class="text-base font-medium text-gray-500 hover:text-gray-900">
              {{ $menupage->title }}
            </a>

          @endforeach

        </nav>
        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
          @auth
            <a href="{{ route('orders.mine') }}" class="px-4 py-2 whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 bg-gray-200 hover:bg-gray-300 rounded-md">
              {{ __('My orders')}}
            </a>
            @if( Auth::user()->isAdmin() )
              <a href="{{ route('dashboard') }}" class="ml-2 whitespace-nowrap px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                {{ __('Dashboard') }}
              </a>
            @endif
          @endauth

          @guest
            <a href="{{ route('login') }}" class="px-4 py-2 whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 bg-gray-200 hover:bg-gray-300 rounded-md">
              {{ __('Sign in')}}
            </a>
            <a href="{{ route('register') }}" class="ml-2 whitespace-nowrap px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
              {{ __('Sign up') }}
            </a>
          @endguest
        </div>
      </div>
    </div>
  </div>

  {{ $slot }}

  @if( env('TALC_COOKIE_CONSENT') )
    @include('cookie-consent::index')
  @endif
</body>
</html>

