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
              <li>
                <div class="flex items-center">
                  <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                  <a href="{{ route('memberships.show', $membership) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $membership->name }}</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ $membership->name }}
            </h2>
          </div>
          <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
            <a href="{{ route('memberships.remove', $membership) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              {{ __('Delete') }}
            </a>
            <a href="{{ route('memberships.edit', $membership) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
            {{ __('Membership Information')}}
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            {{ __('The properties of the membership.') }}
          </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Name') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $membership->name }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Duration') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ __($membership->duration) }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Status') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ __($membership->status) }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Price') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                € {{ number_format($membership->price, 2, ',', '.') }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Extending') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @if( is_null($membership->extend) )
                  {{ __('This membership will not be extended') }}
                @elseif( $membership->extend_id == $membership->id )
                  {{ __('This membership will be automatically extended') }}
                @else
                  {{ __('This membership will be extended with') }} {{ $membership->extend->name }}
                @endif
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Description') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $membership->description }}
              </dd>
            </div>
          </dl>
        </div>
      </div>

    </div>
  </div>

</x-app-layout>
