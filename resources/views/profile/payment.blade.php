<x-web-layout>

  <div class="max-w-3xl mx-auto px-4 sm:px-6 my-20">

    <div class="bg-white shadow overflow-hidden sm:rounded-lg text-gray-700">
      <ul class="divide-y divide-gray-200">
        <li class="bg-green-200 px-6 py-2 text-lg font-bold">{{ __('Order') }} #{{ $order->id }}</li>
        <li class="px-6 py-2">
          {{ __('Date / time') }}:
          <span class="font-bold">{{ $order->created_at->isoFormat('LLL') }}</span>
        </li>
        <li class="px-6 py-2">
          {{ __('Amount') }}:
          <span class="font-bold">€ {{ number_format($order->amount, 2, ',', '.') }}</span>
        </li>
        <li class="px-6 py-2">
          {{ __('Status') }}:
          <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-bold tracking-wider bg-indigo-100 text-indigo-800 uppercase">{{ __($order->status) }}</span>
        </li>
      </ul>
    </div>

    @if( !$order->isPaid() )
      <div class="flex justify-end mt-6">
        <a href="{{ route('orders.pay', $order) }}" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
          {{ __('Pay') }}
        </a>
      </div>
    @endif

  </div>

</x-web-layout>
