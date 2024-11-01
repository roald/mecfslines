<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('pages.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
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
                  <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                  <a href="{{ route('pages.show', $page) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $page->title }}</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $page->title }}
            </h2>
          </div>
          <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
            <a href="{{ route('web.page', $page) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              {{ __('Preview') }}
            </a>
            <a href="{{ route('pages.remove', $page) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              {{ __('Delete') }}
            </a>
            <a href="{{ route('pages.edit', $page) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Edit') }}
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Page Information')}}
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            {{ __('General page properties.') }}
          </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Title') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $page->title }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Slug') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $page->slug }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Page order') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $page->order }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Show page in menu') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $page->menu ? __('Yes') : __('No') }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Description') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $page->description }}
              </dd>
            </div>
            @if( $page->multimedia )
              <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  {{ __('Image') }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  <x-multimedia :multimedia="$page->multimedia" class="h-48 rounded-md" />
                </dd>
              </div>
            @endif
            @if( $page->type == 'redirect' )
              <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  {{ __('Redirect') }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  @php( $action = $page->blocks()->first()->actions()->first() )
                  <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 uppercase">
                    {{ __($action->type) }}
                  </span>
                  <a href="{{ $action->link() }}" class="ml-2 font-medium text-indigo-600 hover:text-indigo-900 hover:underline">
                    @if( $action->type == 'page' )
                      {{ $action->page->title }}
                    @elseif( $action->type == 'url' )
                      {{ $action->target }}
                    @endif
                  </a>
                </dd>
              </div>
            @endif
          </dl>
        </div>
      </div>

    </div>
  </div>

  @if( $page->type == 'page' )
    <div class="py-6">
      <div class="max-w-7xl mx-auto">

        <div class="bg-white shadow overflow-hidden rounded-md">
          <ul class="divide-y divide-gray-200">
            <li class="px-6 py-4">
              <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
                <div class="ml-4 mt-4">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('Page blocks') }}
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    {{ __('These blocks will provide the content for this page.') }}
                  </p>
                </div>
                <div class="ml-4 mt-4 flex-shrink-0">
                  <a href="{{ route('pages.blocks.create', $page) }}" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Create new block') }}
                  </a>
                </div>
              </div>
            </li>
            @foreach( $page->blocks()->orderBy('order', 'asc')->get() as $block )
              <li>
                <a href="{{ route('blocks.show', $block) }}" class="block hover:bg-gray-50">
                  <div class="px-4 py-4 flex items-center sm:px-6">
                    <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                      <div>
                        <div class="flex text-sm font-medium text-indigo-600 truncate">
                          <p>
                            <span class="mr-2 px-1 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">{{ $block->order }}</span>
                            {{ $block->heading }}
                          </p>
                          <p class="ml-1 font-normal text-gray-500">{{ $block->topic }}</p>
                        </div>
                        <div class="mt-2 flex">
                          <div class="flex items-center text-sm text-gray-500">
                            <x-heroicon-o-document-text class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                            <p>{{ $block->body }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="mt-4 flex-shrink-0 sm:mt-0">
                        <div class="flex overflow-hidden">
                          <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                            <svg class="mr-1.5 h-2 w-2 text-indigo-400" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                            {{ $block->type }}
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="ml-5 flex-shrink-0">
                      <x-heroicon-s-chevron-right class="h-5 w-5 text-gray-400" />
                    </div>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endif

</x-app-layout>
