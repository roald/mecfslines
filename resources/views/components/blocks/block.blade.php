<div class="my-20">
  <div class="max-w-4xl mx-auto px-8">
    <h2 class="kop">{{ $block->heading }}</h2>
    <p>{!! nl2br($block->body) !!}</p>
    <x-buttonbar :actions="$block->actions" class="mt-6" />
  </div>
</div>
