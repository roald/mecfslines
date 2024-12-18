<div class="pt-40 pb-20 px-8 relative overflow-hidden">
  <div class="corner-lines absolute -top-[250px] sm:-top-[450px] lg:-top-[350px] xl:-top-[250px] -right-[150px] sm:-right-[240px] w-[400px] sm:w-[600px] h-[400px] sm:h-[600px]"></div>
  <div class="max-w-xl mx-auto text-center">
    <h1 class="title">{!! $block->markdownHeading() !!}</h1>

    <p>{!! nl2br($block->body) !!}</p>

    <x-buttonbar :actions="$block->actions" class="justify-center mt-6" />
  </div>
</div>
