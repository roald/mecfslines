<h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">{{ __('Tags') }}</h2>
<ul class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
  @foreach( $object->tags as $tag )
    <li class="col-span-1 flex shadow-sm rounded-md">
      <div class="flex-shrink-0 flex items-center justify-center w-12 bg-indigo-600 text-white text-sm font-medium rounded-l-md">
        <x-heroicon-o-tag class="h-5 w-5"/>
      </div>
      <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
        <div class="flex-1 px-4 py-2 text-sm truncate">
          <a href="{{ route('tags.show', $tag) }}" class="text-gray-900 font-medium hover:text-gray-600">{{ $tag->name }}</a>
        </div>
        <div class="flex-shrink-0 pr-2">
          <form action="{{ route($route, $object) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="tag_id" value="{{ $tag->id }}">
            <button class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span class="sr-only">{{ __('Remove') }}</span>
              <x-heroicon-o-trash class="h-5 w-5"/>
            </button>
          </form>
        </div>
      </div>
    </li>
  @endforeach
  <li class="col-span-1 flex shadow-sm rounded-md">

    <div class="flex-shrink-0 flex items-center justify-center w-12 bg-green-600 text-white text-sm font-medium rounded-l-md">
      <x-heroicon-o-plus class="h-5 w-5"/>
    </div>
    <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
      <form action="{{ route($route, $object) }}" method="POST" class="block w-full py-0">
        @csrf

        <div class="flex rounded-md shadow-sm w-full">
          <select id="new_tag" name="tag_id" class="px-3 py-2 w-full border-transparent text-sm font-medium text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 h-full pr-7 sm:text-sm">
            <option value="">-</option>
            @foreach( $tags as $tag )
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>
          <button type="submit" class="-ml-mx px-2 py-1 border-transparent text-sm font-medium rounded-r-md text-gray-400 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            <span class="sr-only">{{ __('Add') }}</span>
            <x-heroicon-o-bookmark class="h-5 w-5"/>
          </button>
        </div>
      </form>
    </div>
  </li>
</ul>
