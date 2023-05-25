<div class="my-10 mx-4">
  <div class="max-w-5xl mx-auto">
    <h2 class="text-4xl mb-6">{{ $block->heading }}</h2>

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
  </div>
</div>
