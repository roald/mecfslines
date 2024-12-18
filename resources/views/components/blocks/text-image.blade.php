<div class="my-20">
  <div class="max-w-4xl mx-auto px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-16">
      @if( $block->multimedia->count() > 0 )
        <div class="flex justify-center items-center md:order-last">
          <x-multimedia :multimedia="$block->multimedia()->first()" class="w-96 max-w-full md:w-full rounded-xl" />
        </div>
      @endif

      <div>
        <h2 class="kop">{{ $block->heading }}</h2>
        <p>{!! nl2br($block->body) !!}</p>
        <x-buttonbar :actions="$block->actions" class="mt-4" />
      </div>
    </div>
  </div>
</div>
