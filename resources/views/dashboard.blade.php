<x-app-layout>
  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
        {{ __('Dashboard') }}
      </h2>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div>
        <dl class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
          <div>
            <div class="px-4 py-5 sm:p-6">
              <dt class="text-base font-normal text-gray-900">
                {{ __('Total Users')}}
              </dt>
              <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                  {{ App\Models\User::count() }}
                </div>
              </dd>
            </div>
          </div>

          <div>
            <div class="px-4 py-5 sm:p-6">
              <dt class="text-base font-normal text-gray-900">
                {{ __('Total Events')}}
              </dt>
              <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                  {{ App\Models\Event::count() }}
                </div>
              </dd>
            </div>
          </div>

          <div>
            <div class="px-4 py-5 sm:p-6">
              <dt class="text-base font-normal text-gray-900">
                {{ __('Total Orders') }}
              </dt>
              <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                  € {{ number_format(App\Models\Order::sum('amount'), 2, ',', '.') }}
                </div>
              </dd>
            </div>
          </div>
        </dl>
      </div>

    </div>
  </div>

  <div class="py-6" x-data="{ configOpen: false }">
    <div class="max-w-7xl mx-auto">
      <h3 class="text-lg leading-6 font-bold text-gray-900 hover:underline cursor-pointer" @click="configOpen = !configOpen">
        {{ __('Current configuration') }}
        <x-heroicon-s-eye-off class="h-5 w-5 inline" x-show="!configOpen" />
        <x-heroicon-s-eye class="h-5 w-5 inline" x-show="configOpen" />
      </h3>
    </div>

    <div x-show="configOpen">
      <dl class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
        <x-dashboard-stat :head="__('Events')" :status="env('TALC_EVENTS', false) ? 'on' : 'off'">
          {{ env('TALC_EVENTS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Projects')" :status="env('TALC_PROJECTS', false) ? 'on' : 'off'">
          {{ env('TALC_PROJECTS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Tags')" :status="env('TALC_TAGS', false) ? 'on' : 'off'">
          {{ env('TALC_TAGS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Products')" :status="env('TALC_PRODUCTS', false) ? 'on' : 'off'">
          {{ env('TALC_PRODUCTS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Memberships')" :status="env('TALC_MEMBERSHIPS', false) ? 'on' : 'off'">
          {{ env('TALC_MEMBERSHIPS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Orders & payments')" :status="env('TALC_ORDERS', false) ? 'on' : 'off'">
          {{ env('TALC_ORDERS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Redirects pages')" :status="env('TALC_REDIRECTS', false) ? 'on' : 'off'">
          {{ env('TALC_REDIRECTS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Allow user registration')" :status="env('TALC_REGISTRATION', false) ? 'on' : 'off'">
          {{ env('TALC_REGISTRATION', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Cookie consent for GDPR')" :status="env('TALC_COOKIE_CONSENT', false) ? 'on' : 'off'">
          {{ env('TALC_COOKIE_CONSENT', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Google Analytics')" :status="env('TALC_GOOGLE_ANALYTICS', false) ? 'on' : 'off'">
          {{ env('TALC_GOOGLE_ANALYTICS', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Sending notifications')" :status="env('TALC_NOTIFY_USERS', false) ? 'on' : 'off'">
          @forelse( App\Models\User::find(explode(',', env('TALC_NOTIFY_USERS', 0))) as $user )
            <a href="{{ route('users.show', $user) }}" class="text-indigo-600 hover:text-indigo-900">{{ $user->name }}</a><br/>
          @empty
            {{ __('Off') }}
          @endforelse
        </x-dashboard-stat>
        <x-dashboard-stat :head="__('Media uploads to Amazon')" :status="env('TALC_MEDIA_AMAZON', false) ? 'on' : 'off'">
          {{ env('TALC_MEDIA_AMAZON', false) ? __('On') : __('Off') }}
        </x-dashboard-stat>
      </dl>
      <p class="mt-6">
        {{ __('If you are interested in an extra feature, please contact me for more information.') }}
        <a href="mailto:roald.dijkstra@babbletics.nl?subject=TALC%20functionaliteit" class="align-middle ml-2 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <x-heroicon-s-mail class="h-5 w-5 mr-1" />
          {{ __('Email me') }}
        </a>

      </p>
    </div>
  </div>
</x-app-layout>
