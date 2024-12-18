<div class="my-20">
  <div class="mx-auto max-w-4xl px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h1 class="kop">{{ $block->heading }}</h1>
        <p>{!! nl2br($block->body) !!}</p>
      </div>
      <div>
        @foreach( $block->tags as $tag )
          @if( $tag->type == 'person' )
            @foreach( $tag->projects as $project )
              <div class="bg-wit px-8 py-6 rounded-xl">
                <h2 class="kop">Project</h2>
                <div class="subkop">{{ $project->title }}</div>
                <p>{!! nl2br($project->description) !!}</p>
                <div class="buttonbar mt-6">
                  <a href="{{ route('web.project', $project) }}" class="button">Lees meer</a>
                </div>
              </div>
            @endforeach
          @endif
        @endforeach
      </div>
    </div>
  </div>
</div>