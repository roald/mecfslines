@php( $attributes = $attributes->merge(['class' => 'buttonbar']) )

@if( $actions->count() > 0 )
  <div {{ $attributes }}>
    @foreach( $actions as $action )
      <a href="{{ $action->link() }}" class="button @if($action->type == 'url') external @endif">{{ $action->action }}</a>
    @endforeach
  </div>
@endif
