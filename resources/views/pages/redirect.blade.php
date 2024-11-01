<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
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
              @if( $page->exists )
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('pages.show', $page) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $page->title }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('pages.edit', $page) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('pages.create') }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New redirect') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $page->title ?? __('New redirect') }}
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

        <input type="hidden" name="page_type" value="{{ $page->type }}" />

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
                        <x-heroicon-s-x-circle class="h-5 w-5 text-red-400"/>
                      </div>
                      <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                          {{ trans_choice('There were :count errors', $errors->count()) }}
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
  
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Redirect') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('Redirection attributes.') }}
                </p>
  
              </div>
              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6">
                    <label for="action_type" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <select name="redirect[type]" id="action_type" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Action::$types as $type)
                        <option value="{{ $type }}" @if(old('type', $page->type) == $type) selected @endif>{{ __($type) }}</option>
                      @endforeach
                    </select>
                  </div>
  
                  <div class="col-span-6">
                    <label for="action_page" class="block text-sm font-medium text-gray-700">{{ __('Page') }}</label>
                    <select name="redirect[page_id]" id="action_page" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      <option value=""></option>
                      @foreach($pages as $page)
                        <option value="{{ $page->id }}" @if(old('page_id', $page->page_id) == $page->id) selected @endif>{{ $page->title }}</option>
                      @endforeach
                    </select>
                  </div>
  
                  <div class="col-span-6">
                    <label for="action_target" class="block text-sm font-medium text-gray-700">{{ __('Target') }}</label>
                    <input type="text" name="redirect[target]" id="action_target" value="{{ old('target', $page->target) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
