<x-app-layout>
	<div class="py-6">
	  <div class="max-w-7xl mx-auto">

	  	<!-- This example requires Tailwind CSS v2.0+ -->
  	  <div class="md:flex md:items-center md:justify-between">
  	    <div class="flex-1 min-w-0">
  	      <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
  	        {{ __('Posts') }}
  	      </h2>
  	    </div>
  	    <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
	  	  	<a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('New post') }}</a>
  	    </div>
  	  </div>

		</div>
	</div>

	<div class="py-6">
		<div class="max-w-7xl mx-auto">

			<!-- This example requires Tailwind CSS v2.0+ -->
			<div class="flex flex-col">
			  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
			      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
			        <table class="min-w-full divide-y divide-gray-200">
			          <thead class="bg-gray-50">
			            <tr>
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                {{ __('Title') }}
			              </th>
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                {{ __('Date') }}
			              </th>
			              <th scope="col" class="relative px-6 py-3">
			                <span class="sr-only">{{ __('Edit') }}</span>
			              </th>
			            </tr>
			          </thead>
			          <tbody class="bg-white divide-y divide-gray-200">
			          	@forelse( $posts as $post )
				            <tr>
				              <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
				                <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:text-indigo-900">{{ $post->title }}</a>
				              </td>
				              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
				                {{ $post->published_at->isoFormat('D MMMM YYYY') ?? '-' }}
				              </td>
				              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
				                <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
				              </td>
				            </tr>
				          @empty
				          	<tr>
				          		<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center text-gray-500" colspan="4">
				          			{{ __('There are no posts') }}
				          			<br>
				          			<a href="{{ route('posts.create') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Create your first post') }}</a>
				          		</td>
				          	</tr>
				          @endforelse
			          </tbody>
			        </table>
			      </div>

			      <div class="mt-6">
				      {{ $posts->links() }}
			      </div>
			    </div>
			  </div>
			</div>

		</div>
	</div>

</x-app-layout>
