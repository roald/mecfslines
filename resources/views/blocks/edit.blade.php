<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('pages.show', $block->page) }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
              {{ __('Back') }}
            </a>
          </nav>
          <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              @if( $block->page->type == 'event' )
                <li>
                  <div>
                    <a href="{{ route('events.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Events') }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('events.show', $block->page->event) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $block->page->event->title }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div>
                    <a href="{{ route('pages.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Pages') }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('pages.show', $block->page) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $block->page->title }}</a>
                  </div>
                </li>
              @endif
              @if( $block->exists )
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('blocks.show', $block) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $block->heading }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('blocks.edit', $block) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('pages.blocks.create', $block->page) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New block') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $block->heading ?? __('New block') }}
            </h2>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <form action="{{ $block->exists ? route('blocks.update', $block) : route('pages.blocks.store', $block->page) }}" method="POST">
        @csrf
        @if( $block->exists )
          @method('PATCH')
        @endif

        <div class="space-y-6">
          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Block') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('General block properties.') }}
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
                    <label for="block_type" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <select name="type" id="block_type" autofocus class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach( App\Models\Block::$types as $name => $group )
                        <optgroup label="{{ __($name) }}">
                        @foreach( $group as $type )
                          <option value="{{ $type }}" @if(old('type', $block->type) == $type) selected @endif>{{ __($type) }}</option>
                        @endforeach
                        </optgroup>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="block_heading" class="block text-sm font-medium text-gray-700">{{ __('Heading') }}</label>
                    <input type="text" name="heading" id="block_heading" value="{{ old('heading', $block->heading) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="block_topic" class="block text-sm font-medium text-gray-700">{{ __('Topic') }}</label>
                    <input type="text" name="topic" id="block_topic" value="{{ old('topic', $block->topic) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="block_body" class="block text-sm font-medium text-gray-700">{{ __('Body') }}</label>
                    <textarea id="block_body" name="body" rows="4" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">{{ old('body', $block->body) }}</textarea>
                    @if( env('TALC_MARKDOWN', false) )
                      <div class="mt-1" x-data="{markdown: true}">
                        <div class="text-sm leading-6 text-gray-600 cursor-pointer" @click="markdown = !markdown">
                          <span class="hover:underline">{{ __('Markdown styling information') }}</span>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block" x-show="!markdown">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block" x-show="markdown">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                          </svg>
                        </div>
                        <div class="border border-gray-300 rounded-md py-1 px-2" x-show="markdown">
                          <div class="italic">*{{ __('italic') }}*</div>
                          <div class="font-bold">**{{ __('bold') }}**</div>
                          <div class="italic font-bold">***{{ __('italic & bold') }}***</div>
                          <div class=""><strong>[</strong>{{ __('link text') }}<strong>](</strong>{{ __('URL') }}<strong>)</strong></div>
                          <div class="">- {{ __('list item') }}</div>
                          <div class="text-right"><a href="https://www.markdownguide.org/basic-syntax/" class="hover:underline text-gray-700 text-sm" target="_blank">
                            <span>{{ __('more options') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                          </a></div>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="col-span-6">
                    <label for="block_order" class="block text-sm font-medium text-gray-700">{{ __('Block order') }}</label>
                    <input type="number" name="order" id="block_order" value="{{ old('order', $block->order) }}" min="1" step="1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="block_grant" class="block text-sm font-medium text-gray-700">{{ __('Grant') }}</label>
                    <select name="grant" id="block_grant" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Block::$grants as $grant)
                        <option value="{{ $grant }}" @if(old('grant', $block->grant) == $grant) selected @endif>{{ __($grant) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            <a href="{{ $block->exists ? route('blocks.show', $block) : route('pages.show', $block->page) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
