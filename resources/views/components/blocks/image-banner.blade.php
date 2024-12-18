<div class="relative my-20">
  @if( $block->multimedia()->count() > 0 )
    <div class="absolute top-20 w-full bottom-20 bg-center bg-no-repeat bg-cover" style="background-image: url('{{ $block->multimedia()->first()->imageUrl('large') }}');"></div>
  @endif
  <div class="max-w-4xl mx-auto flex">
    <div class="circle-magenta relative py-32 px-16 min-h-[600px] flex flex-col justify-center">
      <div class="align-middle text-wit max-w-[450px]">
        <h2 class="title">{{ $block->heading }}</h2>
        <p>{!! nl2br($block->body) !!}</p>
        <x-buttonbar :actions="$block->actions" class="mt-6" />
      </div>
    </div>
  </div>
</div>
