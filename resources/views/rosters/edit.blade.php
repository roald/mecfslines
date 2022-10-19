<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('rosters.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
              {{ __('Back') }}
            </a>
          </nav>
          <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              <li>
                <div>
                  <a href="{{ route('rosters.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Rosters') }}</a>
                </div>
              </li>
              @if( $roster->exists )
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('rosters.show', $roster) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $roster->title }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('rosters.edit', $roster) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('rosters.create') }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New roster') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $roster->title ?? __('New roster') }}
            </h2>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <form action="{{ $roster->exists ? route('rosters.update', $roster) : route('rosters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if( $roster->exists )
          @method('PATCH')
        @endif

        <div class="space-y-6">
          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Roster') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('Properties of the roster.') }}
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
                    <label for="roster_weekday" class="block text-sm font-medium text-gray-700">{{ __('Day of the week') }}</label>
                    <select name="weekday" id="roster_weekday" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(range(1, 7) as $day)
                        <option value="{{ $day }}" @if(old('weekday', $roster->weekday) == $day) selected @endif>{{ Carbon\Carbon::now()->startOfWeek($day)->isoFormat('dddd') }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="roster_start_time" class="block text-sm font-medium text-gray-700">{{ __('Start time') }}</label>
                    <input type="time" name="start_time" id="roster_start_time" value="{{ old('start_time', $roster->start_time) }}" autofocus class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="roster_end_time" class="block text-sm font-medium text-gray-700">{{ __('End time') }}</label>
                    <input type="time" name="end_time" id="roster_end_time" value="{{ old('end_time', $roster->end_time) }}" autofocus class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="roster_started_at" class="block text-sm font-medium text-gray-700">{{ __('Starts at') }}</label>
                    <input type="date" name="started_at" id="roster_started_at" value="{{ old('started_at', $roster->started_at->format('Y-m-d')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ Carbon\Carbon::now()->isoFormat('YYYY-MM-DD H:mm') }}">
                  </div>

                  <div class="col-span-6">
                    <label for="roster_ended_at" class="block text-sm font-medium text-gray-700">{{ __('Ends at') }}</label>
                    <input type="date" name="ended_at" id="roster_ended_at" value="{{ old('ended_at', ($roster->ended_at ? $roster->ended_at->format('Y-m-d') : null)) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ Carbon\Carbon::now()->isoFormat('YYYY-MM-DD H:mm') }}">
                  </div>

                  <div class="col-span-6">
                    <label for="roster_title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                    <input type="text" name="title" id="roster_title" value="{{ old('title', $roster->title) }}" autofocus class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="roster_type" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <select name="type" id="roster_type" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Roster::$types as $type)
                        <option value="{{ $type }}" @if(old('type', $roster->type) == $type) selected @endif>{{ __($type) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="roster_url" class="block text-sm font-medium text-gray-700">{{ __('URL') }}</label>
                    <input type="text" name="url" id="roster_url" value="{{ old('url', $roster->url) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="roster_description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea id="roster_description" name="description" rows="4" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">{{ old('description', $roster->description) }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end mt-6">
            <a href="{{ $roster->exists ? route('rosters.show', $roster) : route('rosters.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
