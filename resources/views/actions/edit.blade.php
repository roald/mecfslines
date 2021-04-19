<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('blocks.show', $action->block) }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
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
                  <a href="{{ route('pages.show', $action->block->page) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $action->block->page->title }}</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                  <a href="{{ route('blocks.show', $action->block) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $action->block->heading }}</a>
                </div>
              </li>
              @if( $action->exists )
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('actions.edit', $action) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              @else
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('blocks.actions.create', $action->block) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('New action') }}</a>
                  </div>
                </li>
              @endif
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $action->action ?? __('New action') }}
            </h2>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <form action="{{ $action->exists ? route('actions.update', $action) : route('blocks.actions.store', $action->block) }}" method="POST">
        @csrf
        @if( $action->exists )
          @method('PATCH')
        @endif

        <div class="space-y-6">
          <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">

                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Action') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                  {{ __('Action attributes.') }}
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
                    <label for="action_action" class="block text-sm font-medium text-gray-700">{{ __('Label') }}</label>
                    <input type="text" name="action" id="action_action" value="{{ old('action', $action->action) }}" autofocus class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="action_type" class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <select name="type" id="action_type" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      @foreach(App\Models\Action::$types as $type)
                        <option value="{{ $type }}" @if(old('type', $action->type) == $type) selected @endif>{{ __($type) }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="action_page" class="block text-sm font-medium text-gray-700">{{ __('Page') }}</label>
                    <select name="page_id" id="action_page" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      <option value=""></option>
                      @foreach($pages as $page)
                        <option value="{{ $page->id }}" @if(old('page_id', $action->page_id) == $page->id) selected @endif>{{ $page->title }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-span-6">
                    <label for="action_target" class="block text-sm font-medium text-gray-700">{{ __('Target') }}</label>
                    <input type="text" name="target" id="action_target" value="{{ old('target', $action->target) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>

                  <div class="col-span-6">
                    <label for="action_order" class="block text-sm font-medium text-gray-700">{{ __('Action order') }}</label>
                    <input type="number" name="order" id="action_order" value="{{ old('order', $action->order) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            @if( $action->exists )
              <a href="#" class="mr-3 bg-red-600 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="event.preventDefault(); document.getElementById('removeActionForm').submit();">{{ __('Delete') }}</a>
            @endif

            <a href="{{ $action->exists ? route('actions.show', $action) : route('blocks.actions.index', $action->block) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Cancel') }}
            </a>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Save') }}
            </button>
          </div>
        </div>

      </form>

      @if( $action->exists )
        <form id="removeActionForm" method="POST" action="{{ route('actions.destroy', $action) }}">
          @csrf
          @method('DELETE')
        </form>
      @endif
    </div>
  </div>

</x-app-layout>
