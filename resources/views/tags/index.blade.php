<x-app-layout>
	<div class="py-6">
	  <div class="max-w-7xl mx-auto">

	  	<!-- This example requires Tailwind CSS v2.0+ -->
  	  <div class="md:flex md:items-center md:justify-between">
  	    <div class="flex-1 min-w-0">
  	      <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
  	        {{ __('Tags') }}
  	      </h2>
  	    </div>
  	    <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
	  	  	<a href="{{ route('tags.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('New tag') }}</a>
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
			                {{ __('Name') }}
			              </th>
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                {{ __('Type') }}
			              </th>
			              <th scope="col" class="relative px-6 py-3">
			                <span class="sr-only">{{ __('Edit') }}</span>
			              </th>
			            </tr>
			          </thead>
			          <tbody class="bg-white divide-y divide-gray-200">
			          	@forelse( $tags as $tag )
				            <tr>
				              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
				                <a href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
				              </td>
				              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
				                {{ $tag->type }}
				              </td>
				              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
				                <a href="{{ route('tags.edit', $tag) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
				              </td>
				            </tr>
				          @empty
				          	<tr>
				          		<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center text-gray-500" colspan="4">
				          			{{ __('There are no tags') }}
				          			<br>
				          			<a href="{{ route('tags.create') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Create your first tag') }}</a>
				          		</td>
				          	</tr>
				          @endforelse
			          </tbody>
			        </table>
			      </div>
			    </div>
			  </div>
			</div>

		</div>
	</div>

</x-app-layout>