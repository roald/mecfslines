@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md'
            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  <svg class="mr-3 h-6 w-6 {{ $active ? 'text-gray-500 dark:text-gray-300' : 'text-gray-400 group-hover:text-gray-500 dark:hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
   {{ $path }}
  </svg>
  {{ $slot }}
</a>
