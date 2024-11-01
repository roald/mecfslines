<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('posts.show', $comment->post) }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
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
                  <a href="{{ route('posts.show', $comment->post) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $comment->post->title }}</a>
                </div>
              </li>
              @if( $comment->exists )
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('comments.show', $comment) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $comment->name }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('comments.edit', $comment) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('posts.comments.create', $comment->post) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New comment') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $comment->name ?? __('New comment') }}
            </h2>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <form action="{{ $comment->exists ? route('comments.update', $comment) : route('posts.comments.store', $comment->post) }}" method="POST">
        @csrf
        @if( $comment->exists )
          @method('PATCH')
        @endif

        <div class="space-y-6">
          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Comment') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('General comment properties.') }}
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
                    <label for="comment_name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                    <input type="text" name="name" id="comment_name" value="{{ old('name', $comment->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="comment_user" class="block text-sm font-medium text-gray-700">{{ __('User') }}</label>
                    <select name="user_id" id="comment_user" autofocus class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      <option value="">&ndash;</option>
                      @foreach( $users as $user )
                        <option value="{{ $user->id }}" @if(old('user_id', $comment->user_id) == $user->id) selected @endif>{{ __($user->name) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="comment_message" class="block text-sm font-medium text-gray-700">{{ __('Message') }}</label>
                    <textarea x-data="{
                        resize () {
                          $el.style.height = '0px';
                          $el.style.height = $el.scrollHeight + 'px'
                        }
                      }"
                      x-init="resize()"
                      @input="resize()"
                      type="text" id="comment_message" name="message" rows="4"
                      class="mt-1 w-full min-h-20 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md"
                      placeholder="">{{ old('message', $comment->message) }}</textarea>
                    @if( env('TALC_MARKDOWN', false) )
                      <div class="mt-1" x-data="{markdown: false}">
                        <div class="text-sm leading-6 text-gray-600 cursor-pointer flex items-center gap-1 group" @click="markdown = !markdown">
                          <div class="group-hover:underline">{{ __('Markdown styling information') }}</div>
                          <div :class="{ 'rotate-90': markdown }" class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                            <div class="absolute w-0.5 h-full bg-gray-600 rounded-full"></div>
                            <div :class="{ 'rotate-90': markdown }" class="absolute w-full h-0.5 ease duration-500 bg-gray-600 rounded-full"></div>
                          </div>
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
                    <label for="comment_commented_at" class="block text-sm font-medium text-gray-700">{{ __('Published at') }}</label>
                    <input type="datetime-local" name="commented_at" id="comment_commented_at" value="{{ old('commented_at', $comment->commented_at->isoFormat('YYYY-MM-DD\THH:mm')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ Carbon\Carbon::now()->isoFormat('YYYY-MM-DD') }}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            <a href="{{ $comment->exists ? route('comments.show', $comment) : route('posts.show', $comment->post) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Cancel') }}
            </a>
            @if( $comment->exists )
              <a href="{{ route('comments.remove', $comment) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                {{ __('Delete') }}
              </a>
            @endif
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Save') }}
            </button>
          </div>
        </div>

      </form>

    </div>
  </div>

</x-app-layout>
