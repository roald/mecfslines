@if( $multimedia->type == 'image' )

  @php( $classes = 'object-cover' )

  <img src="{{ $multimedia->imageUrl($size) }}" alt="{{ $multimedia->name }}" {{ $attributes->merge(['class' => $classes]) }} />

@elseif( $multimedia->type == 'video' )

  <video {{ $attributes }} controls="true" controlsList="nodownload" oncontextmenu="return false;" width="100%" poster="{{ $multimedia->posterImage() }}">
    <source src="{{ route('multimedia.stream', $multimedia) }}" type="{{ $multimedia->mimetype() }}" />
    Your browser does not support the <code>video</code> tag.
  </video>

@elseif( $multimedia->type == 'embed')

  @php( $classes = 'object-cover' )

  @if( $size == 'thumb' )
    <img src="{{ $multimedia->posterImage() }}" alt="{{ $multimedia->name }}" {{ $attributes->merge(['class' => $classes]) }} />
  @else
    <div {{ $attributes->merge(['class' => $classes]) }}>
      {!! $multimedia->oembed()->html() !!}
    </div>
  @endif

@endif
