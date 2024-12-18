<div class="my-20">
  <div class="max-w-2xl mx-auto text-center px-8">
    <h2 class="title">{{ $block->heading }}</h2>

    <p>{!! nl2br($block->body) !!}</p>

    <x-buttonbar :actions="$block->actions" class="justify-center mt-6" />
  </div>
</div>
