<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('pages.show', $block->page) }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <!-- Heroicon name: chevron-left -->
              <svg class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
              {{ __('Back') }}
            </a>
          </nav>
          <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              <li>
                <div>
                  <a href="{{ route('pages.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Pages') }}</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <!-- Heroicon name: chevron-right -->
                  <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
                  <a href="{{ route('pages.show', $block->page) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $block->page->title }}</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <!-- Heroicon name: chevron-right -->
                  <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
                  <a href="{{ route('blocks.show', $block) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $block->heading }}</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $block->page->title }} - {{ $block->heading }}
            </h2>
          </div>
          <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
            <a href="{{ route('blocks.remove', $block) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              {{ __('Delete') }}
            </a>
            <a href="{{ route('blocks.edit', $block) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Edit') }}
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Block Information')}}
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            {{ __('Block properties.') }}
          </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Parent') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @if( $block->page->type == 'page' )
                  <a href="{{ route('pages.show', $block->page) }}" class="font-medium text-indigo-600 text-indigo-500">{{ $block->page->title }}</a>
                @elseif( $block->page->type == 'event' )
                  <a href="{{ route('events.show', $block->page->event) }}" class="font-medium text-indigo-600 text-indigo-500">{{ $block->page->event->title }}</a>
                @endif
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Type') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ __($block->type) }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Order') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $block->order }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Heading') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $block->heading }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Topic') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $block->topic }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Body') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $block->body }}
              </dd>
            </div>
          </dl>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <div class="bg-white shadow overflow-hidden rounded-md">
        <ul class="divide-y divide-gray-200">
          <li class="px-6 py-4">
            <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
              <div class="ml-4 mt-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  {{ __('Actions') }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('The actions available within this block.') }}
                </p>
              </div>
              <div class="ml-4 mt-4 flex-shrink-0">
                <a href="{{ route('blocks.actions.create', $block) }}" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  {{ __('Create new action') }}
                </a>
              </div>
            </div>
          </li>
          @foreach( $block->actions()->orderBy('order', 'asc')->get() as $action )
            <li>
              <a href="{{ route('actions.edit', $action) }}" class="block hover:bg-gray-50">
                <div class="px-4 py-4 flex items-center sm:px-6">
                  <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                      <div class="flex text-sm font-medium text-indigo-600 truncate">
                        <p>
                          <span class="mr-2 px-1 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">{{ $action->order }}</span>
                          {{ $action->action }}
                        </p>
                        <p class="ml-1 font-normal text-gray-500">{{ $action->type == 'page' ? $action->page->title : $action->target }}</p>
                      </div>
                    </div>
                    <div class="mt-4 flex-shrink-0 sm:mt-0">
                      <div class="flex overflow-hidden">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                          <svg class="mr-1.5 h-2 w-2 text-indigo-400" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                          </svg>
                          {{ $action->type }}
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="ml-5 flex-shrink-0">
                    <!-- Heroicon name: chevron-right -->
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

</x-app-layout>
