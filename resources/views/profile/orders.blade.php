<x-web-layout>

  <div class="max-w-3xl mx-auto px-4 sm:px-6 my-20">

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <ul class="divide-y divide-gray-200">
        <li class="bg-green-200 px-6 py-2 text-lg font-bold text-gray-700">{{ __('My orders') }}</li>
        @forelse( $orders as $order )
          <li>
            <a href="{{ route('orders.detail', $order) }}" class="block hover:bg-gray-50">
              <div class="px-6 py-4 flex justify-between items-center">
                <div class="flex-1">
                  {{ __('Order') }} #{{ $order->id }}
                </div>
                <div class="ml-5 flex-shrink-0">
                  <!-- Heroicon name: solid/chevron-right -->
                  <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
                </div>
              </div>
            </a>
          </li>
        @empty
          <li class="px-6 py-2 text-center text-gray-500">{{ __('No orders') }}</li>
        @endforelse
      </ul>
    </div>

  </div>

</x-web-layout>
