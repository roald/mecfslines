<div class="my-20">
  <div class="max-w-4xl mx-auto px-8">
    <h2 class="kop">{{ $block->heading }}</h2>

    <div class="md:columns-2 md:gap-10 my-10">
      <p>{!! nl2br($block->body) !!}</p>
      <x-buttonbar :actions="$block->actions" class="mt-6" />
    </div>
  </div>
</div>
