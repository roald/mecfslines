@php( $mediaCount = $block->multimedia()->count() )
<div class="relative my-10 mx-4" x-data="{ galleryOpen: false, activeSlide: 0, numSlides: {{ $mediaCount }} }" @keydown.window.escape="galleryOpen = false">
  <h1 class="text-5xl">{{ $block->heading }}</h1>

  @if( $mediaCount > 0 )
    <div class="columns-2 gap-4 md:columns-3 lg:columns-4 space-y-4">
      @foreach( $block->multimedia as $index => $media)
        <x-multimedia :multimedia="$media" class="gallery-item" @click="activeSlide = {{ $index }}; galleryOpen = true"></x-multimedia>
      @endforeach
    </div>
  @endif

  <p class="text-base">
    {!! nl2br($block->body) !!}
  </p>

  @if( $block->actions->count() > 0 )
    <div class="mt-6 space-x-6">
      @foreach( $block->actions as $action )
        <a href="{{ $action->link() }}" class="py-2 px-4 rounded-lg bg-indigo-600 text-white">{{ $action->action }}</a>
      @endforeach
    </div>
  @endif

  @if( $mediaCount > 0 )
    <div class="h-full w-full fixed top-0 left-0 z-30 bg-gray-600 bg-opacity-80 flex flex-col items-center justify-center" x-show="galleryOpen">
      @foreach( $block->multimedia as $index => $media )
      <x-multimedia :multimedia="$media" :size="'large'" class="max-h-full max-w-full" x-show="activeSlide === {{ $index }}"></x-multimedia>
      @endforeach
      <span class="text-white absolute top-4 right-4" @click="galleryOpen = false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
        </svg>
      </span>
      <div class="absolute w-full bottom-4 flex justify-center items-center space-x-4">
        <span class="text-white" @click="activeSlide = (activeSlide + numSlides - 1) % numSlides">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z" clip-rule="evenodd" />
          </svg>
        </span>
        <span class="text-white font-bold" x-text="(activeSlide + 1) + ' / ' + numSlides"></span>
        <span class="text-white" @click="activeSlide = (activeSlide + 1) % numSlides">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd" />
          </svg>
        </span>
      </div>
    </div>
  @endif
</div>
