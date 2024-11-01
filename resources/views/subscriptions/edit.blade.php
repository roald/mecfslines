<x-app-layout>

    <div class="py-6">
      <div class="max-w-7xl mx-auto">
  
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div>
          <div>
            <nav class="sm:hidden" aria-label="Back">
              <a href="{{ route('users.show', $subscription->user) }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
                {{ __('Back') }}
              </a>
            </nav>
            <nav class="hidden sm:flex" aria-label="Breadcrumb">
              <ol class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="{{ route('users.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Users') }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('users.show', $subscription->user) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $subscription->user->name }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('subscriptions.show', $subscription) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $subscription->membership->name }}</a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                    <a href="{{ route('subscriptions.edit', $subscription) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Edit') }}</a>
                  </div>
                </li>
              </ol>
            </nav>
          </div>
          <div class="mt-2 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
              <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{ $subscription->membership->name }}
              </h2>
            </div>
          </div>
        </div>
  
      </div>
    </div>
  
    <div class="py-6">
      <div class="max-w-7xl mx-auto">
  
        <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
          @csrf
          @method('PATCH')
  
          <div class="space-y-6">
            <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
              <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
  
                  <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Subscription') }}</h3>
                  <p class="mt-1 text-sm text-gray-500">
                    {{ __('Properties of the subscription.') }}
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
                      <label for="subscription_started_at" class="block text-sm font-medium text-gray-700">{{ __('Starts at') }}</label>
                      <input type="date" name="started_at" id="subscription_started_at" value="{{ old('started_at', $subscription->started_at->isoFormat('YYYY-MM-DD')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ Carbon\Carbon::now()->isoFormat('YYYY-MM-DD') }}">
                    </div>
  
                    <div class="col-span-6">
                      <label for="subscription_ended_at" class="block text-sm font-medium text-gray-700">{{ __('Ends at') }}</label>
                      <input type="date" name="ended_at" id="subscription_ended_at" value="{{ old('ended_at', $subscription->ended_at->isoFormat('YYYY-MM-DD')) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="{{ Carbon\Carbon::now()->addMonth(1)->isoFormat('YYYY-MM-DD') }}">
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="flex justify-end mt-6">
              <a href="{{ route('subscriptions.show', $subscription) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
  