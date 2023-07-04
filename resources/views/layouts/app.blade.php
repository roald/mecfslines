<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#1f2937" media="(prefers-color-scheme: dark)">
  <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">

  <title>{{ config('app.name', 'TALC') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">

  <!-- This example requires Tailwind CSS v2.0+ -->
  <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
    @include('layouts.navigation')

    <div class="flex flex-col w-0 flex-1 overflow-hidden">
      <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
        <button @click="sidebarOpen = true" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
          <span class="sr-only">Open sidebar</span>
          <x-heroicon-o-menu class="h-6 w-6"/>
        </button>
      </div>
      <main class="flex-1 relative z-0 overflow-y-auto p-safe-area-inset md:pl-0 focus:outline-none" tabindex="0">
        <div class="md:py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{ $slot }}
          </div>
        </div>
      </main>
    </div>
  </div>

</body>
</html>

