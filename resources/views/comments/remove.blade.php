<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('comments.show', $comment) }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
              {{ __('Back') }}
            </a>
          </nav>
          <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              <li>
                <div>
                  <a href="{{ route('posts.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Posts') }}</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                  <a href="{{ route('posts.show', $comment->post) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $comment->post->title }}</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                  <a href="{{ route('comments.show', $comment) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $comment->heading }}</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                  <a href="{{ route('comments.remove', $comment) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Delete') }}</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $comment->post->title }} - {{ $comment->name }}
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Delete this comment') }}
          </h3>
          <div class="mt-5">
            <form method="POST" action="{{ route('comments.destroy', $comment) }}">
              @csrf
              @method('DELETE')
              <a href="{{ route('comments.destroy', $comment) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Delete') }}
              </a>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>


</x-app-layout>
