<h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">{{ __('Tags') }}</h2>
<ul class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
  @foreach( $object->tags as $tag )
    <li class="col-span-1 flex shadow-sm rounded-md">
      <div class="flex-shrink-0 flex items-center justify-center w-12 bg-indigo-600 text-white text-sm font-medium rounded-l-md">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
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
            <button class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span class="sr-only">{{ __('Remove') }}</span>
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </form>
        </div>
      </div>
    </li>
  @endforeach
  <li class="col-span-1 flex shadow-sm rounded-md">

    <div class="flex-shrink-0 flex items-center justify-center w-12 bg-green-600 text-white text-sm font-medium rounded-l-md">
      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
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
          <button type="submit" class="-ml-mx px-2 py-1 border border-gray-300 text-sm font-medium rounded-r-md text-gray-500 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            <span class="sr-only">{{ __('Add') }}</span>
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </li>
</ul>
