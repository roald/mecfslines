<x-web-layout>

  @foreach( $page->blocks as $block )

    <x-dynamic-component :component="'blocks.'.$block->type" :block="$block" />

  @endforeach

</x-web-layout>
