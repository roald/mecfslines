@php
  $media = $block->multimedia->first();
@endphp
<div class="my-20 bg-magenta dark:bg-magenta-donker text-wit relative overflow-hidden">
  @if( empty($media) )

    <div class="absolute bg-[url('/images/lines-semi.png')] bg-no-repeat bg-contain h-[600px] w-[600px] -right-[300px] -top-1/2"></div>
    <div class="max-w-4xl mx-auto py-20 px-8 relative">
      <h2 class="kop text-wit">{{ $block->heading }}</h2>
      <p>{!! nl2br($block->body) !!}</p>
      <x-buttonbar :actions="$block->actions" class="mt-6" />
    </div>

  @else

    <div class="absolute bg-[url('/images/lines-semi.png')] bg-no-repeat bg-contain h-[600px] w-[600px] -left-[400px]"></div>
    <div class="max-w-4xl mx-auto py-20 px-8 relative grid grid-cols-1 lg:grid-cols-2 gap-10">
      <div>
        <h2 class="kop text-wit">{{ $block->heading }}</h2>
        <p>{!! nl2br($block->body) !!}</p>
        <x-buttonbar :actions="$block->actions" class="mt-6" />
      </div>
      <div>
        <x-multimedia :multimedia="$media" :size="'large'" class="w-96 max-w-full" />
      </div>
    </div>
  
  @endif
</div>
