@props(['status' => '', 'head' => __('Property')])

<div class="{{ ($status == 'on') ? 'bg-green-100' : 'bg-red-100' }}">
  <div class="px-4 py-5 sm:p-6">
    <dt class="text-base font-normal text-gray-900">
      {{ $head }}
    </dt>
    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
      <div class="flex items-baseline text-2xl font-semibold">
        {{ $slot }}
      </div>
    </dd>
  </div>
</div>
