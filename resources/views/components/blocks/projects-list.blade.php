<div class="my-20">
  <div class="max-w-4xl mx-auto px-8">
    <h1 class="kop mb-8">{{ $block->heading }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
      @foreach( $projects as $project )
        <div class="bg-wit dark:bg-blauw py-8 px-8 rounded-xl">
          <h2 class="kop">{{ $project->title }}</h2>
          <p>{!! nl2br($project->description) !!}</p>
          <div class="my-6">
            <a href="{{ route('web.project', $project) }}" class="button">Lees meer</a>
          </div>
        </div>
      @endforeach
    </div>
  </div> 
</div>