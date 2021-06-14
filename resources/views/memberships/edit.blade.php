<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('memberships.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
              {{ __('Back') }}
            </a>
          </nav>
          <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              <li>
                <div>
                  <a href="{{ route('memberships.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Memberships') }}</a>
                </div>
              </li>
              @if( $membership->exists )
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('memberships.show', $membership) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $membership->name }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('memberships.edit', $membership) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('memberships.create') }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New membership') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $membership->name ?? __('New membership') }}
            </h2>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <form action="{{ $membership->exists ? route('memberships.update', $membership) : route('memberships.store') }}" method="POST">
        @csrf
        @if( $membership->exists )
          @method('PATCH')
        @endif

        <div class="space-y-6">
          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Membership') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('Define the properties of the membership.') }}
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
                    <label for="membership_name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                    <input type="text" name="name" id="membership_name" value="{{ old('name', $membership->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="membership_description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea id="membership_description" name="description" rows="4" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">{{ old('description', $membership->description) }}</textarea>
                  </div>

                  <div class="col-span-6">
                    <label for="membership_duration" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <select name="duration" id="membership_duration" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Membership::$durations as $duration)
                        <option value="{{ $duration }}" @if(old('duration', $membership->duration) == $duration) selected @endif>{{ __($duration) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="membership_price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">€</span>
                      </div>
                      <input type="number" name="price" id="membership_price" value="{{ old('price', $membership->price) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md" min="0" step="0.01">
                    </div>
                  </div>

                  <div class="col-span-6">
                    <label for="membership_status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                    <select name="status" id="membership_status" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Membership::$stati as $status)
                        <option value="{{ $status }}" @if(old('status', $membership->status) == $status) selected @endif>{{ __($status) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="membership_extend" class="block text-sm font-medium text-gray-700">{{ __('Extending') }}</label>
                    <select name="extend_id" id="membership_extend" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      <option value="">-</option>
                      @foreach(App\Models\Membership::orderBy('name')->get() as $extension)
                        <option value="{{ $extension->id }}" @if(old('extend_id', $membership->extend_id) == $extension->id) selected @endif>{{ __($extension->name) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            <a href="{{ $membership->exists ? route('memberships.show', $membership) : route('memberships.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
