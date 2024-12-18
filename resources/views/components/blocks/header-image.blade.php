@php
  $media = $block->multimedia()->first();
  $imageUrl = !empty($media) ? $media->imageUrl('large') : '';
@endphp

<div class="bg-groen bg-center bg-no-repeat bg-cover mb-20 overflow-hidden" style="background-image: url('{{ $imageUrl }}');">
  <div class="mx-auto max-w-4xl py-20 sm:py-32 px-8 relative">
    <div class="circle-magenta absolute h-[600px] w-[600px] bottom-0 -left-24"></div>
    <div class="relative">
      <h1 class="title text-wit">{!! $block->markdownHeading() !!}</h1>
      <p>{!! nl2br($block->body) !!}</p>
      <x-buttonbar :actions="$block->actions" />
    </div>
  </div>
</div>