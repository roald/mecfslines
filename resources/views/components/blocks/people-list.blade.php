<div class="my-20">
  <div class="mx-auto max-w-4xl px-8">
    <h1 class="kop text-center mb-8">{{ $block->heading }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
      @foreach( $people as $person )
        <div class="bg-wit dark:bg-blauw py-8 px-8 rounded-xl flex flex-col justify-between">
          <x-multimedia :multimedia="$person->multimedia()->first()" class="w-32 h-32 rounded-xl relative -mt-16 mb-6" />
          <h2 class="kop">{{ $person->name }}</h2>
          <p class="subkop">{{ $person->role }}</p>
          <p>{!! nl2br($person->shortInformation()) !!}</p>
          <div class="my-6">
            <a href="{{ route('web.person', $person) }}" class="button">Lees meer</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>