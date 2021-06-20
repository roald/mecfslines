<x-app-layout>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">

      <div>
        <div>
          <nav class="sm:hidden" aria-label="Back">
            <a href="{{ route('orders.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
              <x-heroicon-s-chevron-left class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400"/>
              {{ __('Back') }}
            </a>
          </nav>
          <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
              <li>
                <div>
                  <a href="{{ route('orders.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Orders') }}</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                  <a href="{{ route('orders.show', $order) }}" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Order') }} #{{ $order->id }}</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
              {{ __('Order') }} #{{ $order->id }} <span class="text-xl text-gray-500">{{ $order->created_at->isoFormat('D MMMM YYYY') }}</span>
            </h2>
          </div>
          @unless( $order->isPaid() )
            <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
              <a href="{{ route('orders.calculate', $order) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('Recalculate') }}
              </a>
              <a href="{{ route('orders.remove', $order) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                {{ __('Delete') }}
              </a>
              <a href="{{ route('orders.edit', $order) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Edit') }}
              </a>
            </div>
          @endunless
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
            {{ __('Order Information')}}
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            {{ __('General order properties.') }}
          </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Date') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $order->created_at->isoFormat('LLL') }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('User') }}
              </dt>
              <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                <a href="{{ route('users.show', $order->user) }}" class="font-bold text-indigo-600 hover:text-indigo-900">{{ $order->user->name }}</a>
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Amount') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                €{{ number_format($order->amount, 2, ',', '.') }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                {{ __('Status') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ __($order->status) }}
              </dd>
            </div>
          </dl>
        </div>
      </div>

    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <ul class="divide-y divide-gray-200">
          <li class="bg-gray-50 px-6 py-2 text-lg font-bold text-gray-900">{{ __('Payments') }}</li>
          @foreach( $order->payments as $payment )
            <li>
              <a href="{{ route('payments.show', $payment) }}" class="block hover:bg-gray-50">
                <div class="px-6 py-4 flex justify-between items-center">
                  <div class="flex-1">
                    <p class="font-medium">{{ $payment->description }}</p>
                    <div class="mt-1 space-x-4">
                      <div class="text-sm text-gray-500 space-x-1 inline-flex items-center">
                        <x-heroicon-o-currency-euro class="h-5 w-5"/>
                        <span class="mr-4">€{{ number_format($payment->amount, 2, ',', '.') }}</span>
                      </div>
                      <div class="text-sm text-gray-500 space-x-1 inline-flex items-center">
                        <x-heroicon-o-calendar class="h-5 w-5"/>
                        <span>{{ $payment->created_at->isoFormat('LLL') }}</span>
                      </div>
                    </div>
                  </div>
                  <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-indigo-100 text-indigo-800 uppercase">{{ __($payment->status) }}</span>
                  </div>
                  <div class="ml-5 flex-shrink-0">
                    <x-heroicon-s-chevron-right class="h-5 w-5 text-gray-400"/>
                  </div>
                </div>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="py-6">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        @if( env('TALC_MEMBERSHIPS') )
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
              <li class="bg-gray-50 px-6 py-2 text-lg font-bold text-gray-900">{{ __('Memberships') }}</li>
              @forelse( $order->subscriptions as $subscription )
                <li>
                  <a href="{{ route('memberships.show', $subscription->membership) }}" class="block hover:bg-gray-50">
                    <div class="px-6 py-4 flex justify-between items-center">
                      <div class="flex-1">
                        {{ $subscription->membership->name }}
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

        @if( env('TALC_PRODUCTS') )
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
              <li class="bg-gray-50 px-6 py-2 text-lg font-bold text-gray-900">{{ __('Products') }}</li>
              @forelse( $order->products as $product )
                <li>
                  <a href="{{ route('products.show', $product) }}" class="block hover:bg-gray-50">
                    <div class="px-6 py-4 flex justify-between items-center">
                      <div class="flex-1">
                        {{ $product->name }}
                      </div>
                      <div class="ml-5 flex-shrink-0">
                        <x-heroicon-s-chevron-right class="h-5 w-5 text-gray-400" />
                      </div>
                    </div>
                  </a>
                </li>
              @empty
                <li class="px-6 py-4 text-center text-gray-500">{{ __('No products') }}</li>
              @endforelse
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>

</x-app-layout>
