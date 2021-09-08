<div class="px-4 bg-green-200">
  <div class="max-w-5xl mx-auto text-gray-700">
    <h1 class="text-5xl font-bold py-16">{{ $block->heading }}</h1>

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
