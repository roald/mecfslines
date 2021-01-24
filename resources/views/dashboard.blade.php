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
</x-app-layout>
