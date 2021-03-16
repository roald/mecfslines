<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('pages.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
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
              @if( $page->exists )
                <li>
                  <div class="flex items-center">
                    <!-- Heroicon name: chevron-right -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('pages.show', $page) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $page->title }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <!-- Heroicon name: chevron-right -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('pages.edit', $page) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <!-- Heroicon name: chevron-right -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('pages.create') }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New page') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $page->title ?? __('New page') }}
            </h2>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <form action="{{ $page->exists ? route('pages.update', $page) : route('pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if( $page->exists )
          @method('PATCH')
        @endif

        <div class="space-y-6">
          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Page') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('General page properties.') }}
                </p>

                @if($errors->count())
                  <!-- This example requires Tailwind CSS v2.0+ -->
                  <div class="rounded-md mt-4 bg-red-50 p-4">
                    <div class="flex">
                      <div class="flex-shrink-0">
                        <!-- Heroicon name: x-circle -->
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                          {{ __('There were :num error(s)', ['num' => $errors->count()]) }}
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                          <ul class="list-disc pl-5 space-y-1">
                            @foreach( $errors->all() as $error )
                              <li>
                                {{ $error }}
                              </li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

              </div>
              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6">
                    <label for="page_title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                    <input type="text" name="title" id="page_title" value="{{ old('title', $page->title) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="page_slug" class="block text-sm font-medium text-gray-700">
                      {{ __('Slug') }}
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-100 text-gray-500 text-sm">
                        {{ url('page') }}/
                      </span>
                      <input type="text" name="slug" id="page_slug" value="{{ old('slug', $page->slug) }}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="page_name">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      {{ __('A page slug should be all lowercase and may not contain spaces.')}}
                    </p>
                  </div>

                  <div class="col-span-6">
                    <label for="page_description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea id="page_description" name="description" rows="4" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">{{ old('description', $page->description) }}</textarea>
                  </div>

                  <div class="col-span-6">
                    <label for="page_order" class="block text-sm font-medium text-gray-700">{{ __('Page order') }}</label>
                    <input type="number" name="order" id="page_order" value="{{ old('order', $page->order) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="page_status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                    <select name="status" id="page_status" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Page::$stati as $status)
                        <option value="{{ $status }}" @if(old('status', $page->status) == $status) selected @endif>{{ __($status) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <div class="text-sm font-medium text-gray-700">{{ __('Menu') }}</div>
                    <div class="flex items-start mt-1">
                      <div class="h-5 flex items center">
                        <input type="checkbox" id="page_menu" name="menu" @if(old('menu', $page->menu)) checked @endif class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                      </div>
                      <div class="ml-3 text-sm">
                        <label for="page_menu" class="font-medium text-gray-700">{{ __('Show page in menu') }}</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Image') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('Linked image for this page.') }}
                </p>
              </div>
              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="grid grid-cols-6 gap-6">
                  @if ($page->hasMedia('media'))
                    <div class="col-span-6 flex">
                      <div class="w-full">
                        <div class="text-sm font-medium text-gray-700">{{ __('Remove media') }}</div>
                        <div class="flex items-start mt-1">
                          <div class="h-5 flex items center">
                            <input type="checkbox" id="page_remove_media" name="remove_media" @if(old('remove_media')) checked @endif class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="page_remove_media" class="font-medium text-gray-700">
                              <span>{{ __('Remove file') }}:</span>
                              <span class="font-bold">{{ $page->getFirstMedia('media')->file_name }}</span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="ml-4 flex-shrink-0">
                        <img src="{{ $page->getFirstMediaUrl('media', 'thumb') }}" class="h-32 border border-gray-300 rounded-md">
                      </div>
                    </div>
                  @endif

                  <div class="col-span-6">
                    <label for="page_media" class="block text-sm font-medium text-gray-700">{{ __('Upload image') }}</label>
                    <div class="mt-1 shadow-sm border border-gray-300 block w-full rounded-md">
                      <input type="file" id="page_media" name="media" class="bg-gray-50 sm:text-sm border-transparent rounded-md">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      {{ __('Select your JPG / PNG image to link to this page (max. 10MB).')}}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end mt-6">
            <a href="{{ $page->exists ? route('pages.show', $page) : route('pages.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Cancel') }}
            </a>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Save') }}
            </button>
          </div>
        </div>

      </form>

    </div>
  </div>

</x-app-layout>
