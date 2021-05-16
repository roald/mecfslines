<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('events.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
              {{ __('Back') }}
            </a>
          </nav>
          <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              <li>
                <div>
                  <a href="{{ route('events.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Events') }}</a>
                </div>
              </li>
              @if( $event->exists )
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('events.show', $event) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $event->title }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('events.edit', $event) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('events.create') }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New event') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $event->title ?? __('New event') }}
            </h2>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <form action="{{ $event->exists ? route('events.update', $event) : route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if( $event->exists )
          @method('PATCH')
        @endif

        <div class="space-y-6">
          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Event') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('Properties of the event.') }}
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
                    <label for="event_title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                    <input type="text" name="title" id="event_title" value="{{ old('title', $event->title) }}" autofocus class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="event_slug" class="block text-sm font-medium text-gray-700">
                      {{ __('Slug') }}
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-100 text-gray-500 text-sm">
                        {{ url('event') }}/
                      </span>
                      <input type="text" name="slug" id="event_slug" value="{{ old('slug', $event->slug) }}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="event_name">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      {{ __('A page slug should be all lowercase and may not contain spaces.')}}
                    </p>
                  </div>

                  <div class="col-span-6">
                    <label for="event_type" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <select name="type" id="event_type" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Event::$types as $type)
                        <option value="{{ $type }}" @if(old('type', $event->type) == $type) selected @endif>{{ __($type) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="event_description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea id="event_description" name="description" rows="4" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">{{ old('description', $event->description) }}</textarea>
                  </div>

                  <div class="col-span-6">
                    <label for="event_started_at" class="block text-sm font-medium text-gray-700">{{ __('Starts at') }}</label>
                    <input type="datetime-local" name="started_at" id="event_started_at" value="{{ old('started_at', $event->started_at->format('Y-m-d\TH:i')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ Carbon\Carbon::now()->isoFormat('YYYY-MM-DD H:mm') }}">
                  </div>

                  <div class="col-span-6">
                    <label for="event_ended_at" class="block text-sm font-medium text-gray-700">{{ __('Ends at') }}</label>
                    <input type="datetime-local" name="ended_at" id="event_ended_at" value="{{ old('ended_at', $event->ended_at->format('Y-m-d\TH:i')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ Carbon\Carbon::now()->isoFormat('YYYY-MM-DD H:mm') }}">
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
                  {{ __('Linked image for this event.') }}
                </p>
              </div>
              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="grid grid-cols-6 gap-6">
                  @if ($event->multimedia)
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
                              <span class="font-bold">{{ $event->multimedia->fileName() }}</span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="ml-4 flex-shrink-0">
                        <x-multimedia :multimedia="$event->multimedia" class="h-32 border border-gray-300 rounded-md" />
                      </div>
                    </div>
                  @endif

                  <div class="col-span-6">
                    <label for="page_media" class="block text-sm font-medium text-gray-700">{{ __('Upload image') }}</label>
                    <div class="mt-1 shadow-sm border border-gray-300 block w-full rounded-md">
                      <input type="file" id="page_media" name="media" class="bg-gray-50 sm:text-sm border-transparent rounded-md">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      {{ __('Select your JPG / PNG image to link to this event (max. 10MB).')}}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end mt-6">
            <a href="{{ $event->exists ? route('events.show', $event) : route('events.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
