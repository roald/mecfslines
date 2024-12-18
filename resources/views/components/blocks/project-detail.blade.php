<div class="my-20">
  <div class="max-w-4xl mx-auto px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h1 class="kop">{{ $block->heading }}</h1>
        <p>{!! nl2br($block->body) !!}</p>
      </div>
      <div>
        @foreach( $block->tags as $tag )
          @if( $tag->type == 'person' )
            <div class="bg-wit px-8 mt-12 md:mt-0 py-6 rounded-xl relative">
              @php( $person = $tag->people()->first() )
              @if( !empty($person) && $person->multimedia()->count() > 0 )
                <x-multimedia :multimedia="$person->multimedia()->first()" class="w-32 h-32 rounded-xl relative -mt-16 mb-6" />
              @endif
              <div class="color-lines w-48 h-48 absolute -top-16 -right-32"></div>
              <h2 class="kop">{{ $tag->name }}</h2>
              <p>{!! nl2br($tag->description) !!}</p>
            </div>
          @endif  

          @if( $block->actions->count() > 0 )
            <div class="mt-8 py-6 px-8 bg-wit rounded-xl">
              <h2 class="kop">Meer informatie</h2>
              <x-buttonbar :actions="$block->actions" class="flex-col items-start" />
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</div>