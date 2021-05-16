@if( $multimedia->type == 'image' )

  @php
    $classes = 'object-cover';
  @endphp

  <img src="{{ $multimedia->imageUrl('thumb') }}" alt="{{ $multimedia->name }}" {{ $attributes->merge(['class' => $classes]) }} />

@elseif( $multimedia->type == 'video' )

  <video {{ $attributes }} controls="true" controlsList="nodownload" oncontextmenu="return false;" width="100%" poster="{{ $multimedia->posterImage() }}">
    <source src="{{ route('multimedia.stream', $multimedia) }}" type="{{ $multimedia->mimetype() }}" />
    Your browser does not support the <code>video</code> tag.
  </video>

@endif
