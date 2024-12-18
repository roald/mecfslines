<!-- Responsive sidebar for mobile -->
<nav class="md:hidden" x-show="sidebarOpen">
  <div class="fixed inset-0 flex z-40">
    <div @click="sidebarOpen = false" x-show="sidebarOpen" x-transition:enter-start="opacity-0" x-transation:enter-end="opacity-100" x-transition:leave-start="opacity-100" x-transation:leave-end="opacity-0" class="fixed inset-0 transition-opacity ease-linear duration-300">
      <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
    </div>

    <div x-show="sidebarOpen" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full pl-safe-area-inset pt-safe-area-inset bg-white dark:bg-gray-800 transition transform ease-in-out duration-300">
      <div class="absolute top-0 right-0 -mr-12 pt-2">
        <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
          <span class="sr-only">Close sidebar</span>
          <!-- Heroicon name: x -->
          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
        <div class="flex-shrink-0 flex items-center px-4">
          <a href="{{ route('web.home') }}" class="text-4xl font-bold text-green-500 hover:text-green-600">MECFS Lines</a>
        </div>
        <nav class="mt-5 px-2 space-y-1">
          <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </x-slot>
            {{ __('Dashboard') }}
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('pages.index')" :active="request()->is('admin/pages*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </x-slot>
            {{ __('Pages') }}
          </x-responsive-nav-link>

          @if( env('TALC_EVENTS') )
            <x-responsive-nav-link :href="route('events.index')" :active="request()->is('admin/events*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
              </x-slot>
              {{ __('Events') }}
            </x-responsive-nav-link>
          @endif

          @if( env('TALC_ROSTER') )
            <x-responsive-nav-link :href="route('rosters.index')" :active="request()->is('admin/rosters*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </x-slot>
              {{ __('Roster') }}
            </x-responsive-nav-link>
          @endif

          @if( env('TALC_POSTS') )
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->is('admin/posts*')">
              <x-slot name="path">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>                
              </x-slot>
              {{ __('Posts') }}
            </x-responsive-nav-link>
          @endif

          @if( env('TALC_PEOPLE') )
            <x-responsive-nav-link :href="route('people.index')" :active="request()->is('admin/people*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </x-slot>
              {{ __('People') }}
            </x-responsive-nav-link>
          @endif

          @if( env('TALC_PRODUCTS') )
            <x-responsive-nav-link :href="route('products.index')" :active="request()->is('admin/products*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </x-slot>
              {{ __('Products') }}
            </x-responsive-nav-link>
          @endif

          @if( env('TALC_PROJECTS') )
            <x-responsive-nav-link :href="route('projects.index')" :active="request()->is('admin/projects*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
              </x-slot>
              {{ __('Projects') }}
            </x-responsive-nav-link>
          @endif

          <x-responsive-nav-link :href="route('users.index')" :active="request()->is('admin/users*')">
            <x-slot name="path">aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </x-slot>
            {{ __('Users') }}
          </x-responsive-nav-link>

          @if( env('TALC_ORDERS') )
            <x-responsive-nav-link :href="route('orders.index')" :active="request()->is('admin/orders*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z" />
              </x-slot>
              {{ __('Orders') }}
            </x-responsive-nav-link>
          @endif

          @if( env('TALC_MEMBERSHIPS') )
            <x-responsive-nav-link :href="route('memberships.index')" :active="request()->is('admin/memberships*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
              </x-slot>
              {{ __('Memberships') }}
            </x-responsive-nav-link>
          @endif

          @if( env('TALC_TAGS') )
            <x-responsive-nav-link :href="route('tags.index')" :active="request()->is('admin/tags*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
              </x-slot>
              {{ __('Tags') }}
            </x-responsive-nav-link>
          @endif
        </nav>
      </div>
      <div class="flex-shrink-0 flex border-t border-gray-200 dark:border-gray-700 dark:bg-gray-700 p-4">
        <a href="{{ route('admin.profile') }}" class="flex-shrink-0 group block pl-safe-area-inset">
          <div class="flex items-center">
            <div>
              <span class="inline-block h-9 w-9 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-200">
                <img src="{{ Auth::user()->gravatar() }}" alt="" class="h-full w-full">
              </span>
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900 dark:text-white dark:group-hover:text-white">
                {{ Auth::user()->name }}
              </p>
              <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300">
                {{ __('Profile / log out') }}
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="flex-shrink-0 w-14">
      <!-- Force sidebar to shrink to fit close icon -->
    </div>
  </div>
</nav>

<!-- Static sidebar for desktop -->
<nav class="hidden md:flex md:flex-shrink-0">
  <div class="flex flex-col w-64">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex flex-col h-0 flex-1 border-r border-gray-200 bg-white dark:bg-gray-800">
      <div class="flex-1 flex flex-col pt-5 pb-4 pl-safe-area-inset overflow-y-auto">
        <div class="flex items-center flex-shrink-0 px-4">
          <a href="{{ route('web.home') }}" class="text-4xl font-bold text-green-500 hover:text-green-600">MECFS Lines</a>
        </div>
        <nav class="mt-5 flex-1 px-2 bg-white dark:bg-gray-800 space-y-1">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </x-slot>
            {{ __('Dashboard') }}
          </x-nav-link>

          <x-nav-link :href="route('pages.index')" :active="request()->is('admin/pages*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </x-slot>
            {{ __('Pages') }}
          </x-nav-link>

          @if( env('TALC_EVENTS') )
            <x-nav-link :href="route('events.index')" :active="request()->is('admin/events*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
              </x-slot>
              {{ __('Events') }}
            </x-nav-link>
          @endif

          @if( env('TALC_ROSTER') )
            <x-nav-link :href="route('rosters.index')" :active="request()->is('admin/rosters*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </x-slot>
              {{ __('Roster') }}
            </x-nav-link>
          @endif

          @if( env('TALC_POSTS') )
            <x-nav-link :href="route('posts.index')" :active="request()->is('admin/posts*')">
              <x-slot name="path">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
              </x-slot>
              {{ __('Posts') }}
            </x-nav-link>
          @endif
                          
          @if( env('TALC_PEOPLE') )
            <x-nav-link :href="route('people.index')" :active="request()->is('admin/people*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </x-slot>
              {{ __('People') }}
            </x-nav-link>
          @endif

          @if( env('TALC_PRODUCTS') )
            <x-nav-link :href="route('products.index')" :active="request()->is('admin/products*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </x-slot>
              {{ __('Products') }}
            </x-nav-link>
          @endif

          @if( env('TALC_PROJECTS') )
            <x-nav-link :href="route('projects.index')" :active="request()->is('admin/projects*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
              </x-slot>
              {{ __('Projects') }}
            </x-nav-link>
          @endif

          <x-nav-link :href="route('users.index')" :active="request()->is('admin/users*')">
            <x-slot name="path">aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </x-slot>
            {{ __('Users') }}
          </x-nav-link>

          @if( env('TALC_ORDERS') )
            <x-nav-link :href="route('orders.index')" :active="request()->is('admin/orders*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z" />
              </x-slot>
              {{ __('Orders') }}
            </x-nav-link>
          @endif

          @if( env('TALC_MEMBERSHIPS') )
            <x-nav-link :href="route('memberships.index')" :active="request()->is('admin/memberships*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
              </x-slot>
              {{ __('Memberships') }}
            </x-nav-link>
          @endif

          @if( env('TALC_TAGS') )
            <x-nav-link :href="route('tags.index')" :active="request()->is('admin/tags*')">
              <x-slot name="path">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
              </x-slot>
              {{ __('Tags') }}
            </x-nav-link>
          @endif
        </nav>
      </div>
      <div class="flex-shrink-0 flex border-t border-gray-200 dark:border-gray-700 dark:bg-gray-700 p-4">
        <a href="{{ route('admin.profile') }}" class="flex-shrink-0 w-full group block pl-safe-area-inset">
          <div class="flex items-center">
            <div>
              <span class="inline-block h-9 w-9 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-200">
                <img src="{{ Auth::user()->gravatar() }}" alt="" class="h-full w-full">
              </span>
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900 dark:text-white dark:group-hover:text-white">
                {{ Auth::user()->name }}
              </p>
              <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300">
                {{ __('Profile / log out') }}
              </p>
            </div>
          </div>
        </a>
        </form>
      </div>
    </div>
  </div>
</nav>
