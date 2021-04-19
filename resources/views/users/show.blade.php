<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('users.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
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
                  <a href="{{ route('users.show', $user) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $user->name }}</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $user->name }}
            </h2>
          </div>
          <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
            <a href="{{ route('users.remove', $user) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              {{ __('Delete') }}
            </a>
            <a href="{{ route('users.edit', $user) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Edit') }}
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('User Information') }}
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            {{ __('General user properties.') }}
          </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Name') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $user->name }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Email') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $user->email }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Role') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ __($user->role) }}
              </dd>
            </div>
          </dl>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        @if( env('TALC_MEMBERSHIPS') )
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
              <li class="bg-gray-50 px-6 py-2 text-lg font-bold text-gray-900">{{ __('Subscriptions') }}</li>
              @forelse( $user->subscriptions as $subscription )
                <li>
                  <a href="{{ route('subscriptions.show', $subscription) }}" class="block hover:bg-gray-50">
                    <div class="px-6 py-4 flex justify-between items-center">
                      <div class="flex-1">
                        <p class="block font-medium">{{ $subscription->membership->name }}</p>
                        @if( $subscription->started_at )
                          <p class="block text-sm">{{ $subscription->started_at->isoFormat('D MMM YYYY') }} &ndash; {{ $subscription->ended_at->isoFormat('D MMM YYYY') }}</p>
                        @endif
                      </div>
                      <div class="ml-5 flex-shrink-0">
                        <x-heroicon-s-chevron-right class="h-5 w-5 text-gray-400" />
                      </div>
                    </div>
                  </a>
                </li>
              @empty
                <li class="px-6 py-2 text-center text-gray-500">{{ __('No subscriptions') }}</li>
              @endforelse
            </ul>
          </div>
        @endif

        @if( env('TALC_ORDERS') )
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
              <li class="bg-gray-50 px-6 py-2">
                <div class="flex justify-between items-center">
                  <span class="text-lg font-bold text-gray-900">{{ __('Orders') }}</span>
                  <a href="{{ route('users.orders.create', $user) }}" class="inline-flex items-center px-1.5 py-0.5 border border-transparent rounded-md shadow-sm text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('New order') }}</a>
                </div>
              </li>
              @forelse( $user->orders as $order )
                <li>
                  <a href="{{ route('orders.show', $order) }}" class="block hover:bg-gray-50">
                    <div class="px-6 py-4 flex justify-between items-center">
                      <div class="flex-1">
                        <p class="block font-medium">{{ __('Order') }} #{{ $order->id }}</p>
                        <p class="block text-sm">{{ $order->created_at->isoFormat('LLL') }}</p>
                      </div>
                      <div class="ml-5 flex-shrink-0">
                        <x-heroicon-s-chevron-right class="h-5 w-5 text-gray-400" />
                      </div>
                    </div>
                  </a>
                </li>
              @empty
                <li class="px-6 py-2 text-center text-gray-500">{{ __('No orders') }}</li>
              @endforelse
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>

</x-app-layout>
