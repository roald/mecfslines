<x-app-layout>
  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            {{ __('Orders') }}
          </h2>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      {{ __('User') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      {{ __('Amount') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      {{ __('Date / time') }}
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                      <span class="sr-only">{{ __('Edit') }}</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @forelse( $orders as $order )
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <a href="{{ route('orders.show', $order) }}">{{ $order->user->name }}</a>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        € {{ number_format($order->amount, 2, ',', '.') }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if( $order->payed_at )
                          {{ $order->payed_at->format('d F j, H:i') }}
                        @else
                          {{ __('Pending') }}
                        @endif
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('orders.edit', $order) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center text-gray-500" colspan="4">
                        {{ __('There are no orders') }}
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</x-app-layout>