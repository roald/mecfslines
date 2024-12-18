<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') || localStorage.setItem('darkMode', 'system')}" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" x-bind:class="{'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>{{ config('app.name', 'TALC') }}</title>
  
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@100..900&display=swap">
  
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  
  @if( env('TALC_MATOMO', false) )
  <x-matomo :container="env('MATOMO_CONTAINER_URL')" />
  @endif
</head>
<body class="font-web antialiased bg-wit-donker dark:bg-blauw-donker text-blauw dark:text-wit font-normal text-lg" x-data="{ menuOpen: false }" @keydown.window.escape="menuOpen = false">
  
  <div class="overlay" x-show="menuOpen">
    <div class="bg-wit dark:bg-blauw overflow-hidden">
      <div class="max-w-4xl mx-auto px-8 py-8">
        <div class="flex justify-end">
          <span class="cursor-pointer" @click="menuOpen = false">
            <svg width="32px" height="32px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
              <g transform="matrix(1,0,0,1,-25140.5,-41.5976)">
                <g transform="matrix(0.707107,0.707107,-0.290363,0.290363,24423.7,-679.413)">
                  <rect x="1018.64" y="2.5" width="40.211" height="9.438" fill="currentColor" />
                </g>
                <g transform="matrix(0.707107,-0.707107,0.290363,0.290363,24419.5,789.59)">
                  <rect x="1018.64" y="2.5" width="40.211" height="9.438" fill="currentColor" />
                </g>
              </g>
            </svg>
          </span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 my-6 sm:my-20">
          <div class="justify-center items-center hidden sm:flex">
            <img src="/images/lines-color.png" alt="" class="w-72 h-72" />
          </div>
          <nav class="flex flex-col gap-4">
            @foreach( $menu as $menupage )
            <a href="{{ route('web.page', $menupage) }}" class="text-2xl hover:text-magenta">
              {{ $menupage->title }}
            </a>
            @endforeach
            <div class="mt-6 sm:mt-20 flex justify-end gap-2">
              <span x-on:click="darkMode = 'light'" class="cursor-pointer hover:text-magenta" :class="{ 'text-magenta': darkMode === 'light' }" title="Licht thema">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
              </span>
              <span x-on:click="darkMode = 'dark'" class="cursor-pointer hover:text-magenta" :class="{ 'text-magenta': darkMode === 'dark' }" title="Donker thema">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
              </span>
              <span x-on:click="darkMode = 'system'" class="cursor-pointer hover:text-magenta" :class="{ 'text-magenta': darkMode === 'system' }" title="Volg systeem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-monitor"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>
              </span>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  
  <div class="relative bg-wit dark:bg-blauw">
    <div class="max-w-4xl mx-auto px-8">
      <div class="flex justify-between items-center py-6">
        <a href="{{ route('web.home') }}" class="flex items-center">
          <div class="w-12 h-12 mr-4 logo"></div>
          <div class="flex flex-col justify-center font-bold">
            <div class="text-3xl leading-7">MECFS Lines</div>
            <div class="text-sm leading-3">MECVS-onderzoeksconsortium en biobank</div>
          </div>
        </a>
        <nav>
          <span class="cursor-pointer" @click="menuOpen = true">
            <svg width="41px" height="27px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
              <g transform="matrix(1,0,0,1,-22957.9,-43.7235)">
                <g transform="matrix(1,0,0,0.410635,21939.2,42.6969)">
                  <rect x="1018.64" y="2.5" width="40.211" height="9.438" fill="currentColor" />
                </g>
                <g transform="matrix(1,0,0,0.410635,21939.2,54.2201)">
                  <rect x="1018.64" y="2.5" width="40.211" height="9.438" fill="currentColor" />
                </g>
                <g transform="matrix(1,0,0,0.410635,21939.2,65.7433)">
                  <rect x="1018.64" y="2.5" width="40.211" height="9.438" fill="currentColor" />
                </g>
              </g>
            </svg>
          </span>
        </nav>
      </div>
    </div>
  </div>
  
  {{ $slot }}
  
  <footer class="relative bg-blauw dark:bg-blauw-donker text-wit -mt-10">
    <div class="max-w-4xl mx-auto px-8 py-12 flex gap-12">
      <div>
        <div class="w-32 h-32 white-lines"></div>
        <div class="mt-4 text-4xl leading-8 font-bold">MECFS<br/>Lines</div>
      </div>
      <div class="ml-12 flex flex-col gap-2 font-bold text-lg md:text-2xl">
        @foreach( $menu as $menupage )
        <a href="{{ route('web.page', $menupage) }}" class="hover:text-wit-donker">
          {{ $menupage->title }}
        </a>
        @endforeach
        <a href="{{ route('admin') }}" class="hover:text-wit-donker">Beheer</a>
      </div>
    </div>
  </footer>
  
  @if( env('TALC_COOKIE_CONSENT') )
  @include('cookie-consent::index')
  @endif
</body>
</html>

