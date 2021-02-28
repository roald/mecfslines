<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div class="md:hidden">
  <div class="fixed inset-0 flex z-40">
    <!--
      Off-canvas menu overlay, show/hide based on off-canvas menu state.

      Entering: "transition-opacity ease-linear duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "transition-opacity ease-linear duration-300"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0">
      <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
    </div>
    <!--
      Off-canvas menu, show/hide based on off-canvas menu state.

      Entering: "transition ease-in-out duration-300 transform"
        From: "-translate-x-full"
        To: "translate-x-0"
      Leaving: "transition ease-in-out duration-300 transform"
        From: "translate-x-0"
        To: "-translate-x-full"
    -->
    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white dark:bg-gray-800">
      <div class="absolute top-0 right-0 -mr-12 pt-2">
        <button class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
          <span class="sr-only">Close sidebar</span>
          <!-- Heroicon name: x -->
          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
        <div class="flex-shrink-0 flex items-center px-4">
          <a href="{{ route('web.home') }}" class="text-4xl font-bold text-green-500 hover:text-green-600">TALC</a>
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

          <x-responsive-nav-link :href="route('events.index')" :active="request()->is('admin/events*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </x-slot>
            {{ __('Events') }}
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('products.index')" :active="request()->is('admin/products*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </x-slot>
            {{ __('Products') }}
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('users.index')" :active="request()->is('admin/users*')">
            <x-slot name="path">aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </x-slot>
            {{ __('Users') }}
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('orders.index')" :active="request()->is('admin/orders*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z" />
            </x-slot>
            {{ __('Orders') }}
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('memberships.index')" :active="request()->is('admin/memberships*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </x-slot>
            {{ __('Memberships') }}
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('tags.index')" :active="request()->is('admin/tags*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </x-slot>
            {{ __('Tags') }}
          </x-responsive-nav-link>
        </nav>
      </div>
      <div class="flex-shrink-0 flex border-t border-gray-200 dark:border-gray-700 dark:bg-gray-700 p-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" class="flex-shrink-0 group block" onclick="event.preventDefault(); this.closest('form').submit();">
            <div class="flex items-center">
              <div>
                <span class="inline-block h-9 w-9 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-200">
                  <svg class="h-full w-full text-gray-300 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                </span>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900 dark:text-white dark:group-hover:text-white">
                  {{ Auth::user()->name }}
                </p>
                <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300">
                  {{ __('Log out') }}
                </p>
              </div>
            </div>
          </a>
        </form>
      </div>
    </div>
    <div class="flex-shrink-0 w-14">
      <!-- Force sidebar to shrink to fit close icon -->
    </div>
  </div>
</div>

<!-- Static sidebar for desktop -->
<div class="hidden md:flex md:flex-shrink-0">
  <div class="flex flex-col w-64">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex flex-col h-0 flex-1 border-r border-gray-200 bg-white dark:bg-gray-800">
      <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
        <div class="flex items-center flex-shrink-0 px-4">
          <a href="{{ route('web.home') }}" class="text-4xl font-bold text-green-500 hover:text-green-600">TALC</a>
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

          <x-nav-link :href="route('events.index')" :active="request()->is('admin/events*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </x-slot>
            {{ __('Events') }}
          </x-nav-link>

          <x-nav-link :href="route('products.index')" :active="request()->is('admin/products*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </x-slot>
            {{ __('Products') }}
          </x-nav-link>

          <x-nav-link :href="route('users.index')" :active="request()->is('admin/users*')">
            <x-slot name="path">aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </x-slot>
            {{ __('Users') }}
          </x-nav-link>

          <x-nav-link :href="route('orders.index')" :active="request()->is('admin/orders*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z" />
            </x-slot>
            {{ __('Orders') }}
          </x-nav-link>

          <x-nav-link :href="route('memberships.index')" :active="request()->is('admin/memberships*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </x-slot>
            {{ __('Memberships') }}
          </x-nav-link>

          <x-nav-link :href="route('tags.index')" :active="request()->is('admin/tags*')">
            <x-slot name="path">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </x-slot>
            {{ __('Tags') }}
          </x-nav-link>
        </nav>
      </div>
      <div class="flex-shrink-0 flex border-t border-gray-200 dark:border-gray-700 dark:bg-gray-700 p-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" class="flex-shrink-0 w-full group block" onclick="event.preventDefault(); this.closest('form').submit();">
            <div class="flex items-center">
              <div>
                <span class="inline-block h-9 w-9 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-200">
                  <svg class="h-full w-full text-gray-300 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                </span>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900 dark:text-white dark:group-hover:text-white">
                  {{ Auth::user()->name }}
                </p>
                <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700 dark:text-gray-300 dark:group-hover:text-gray-200">
                  {{ __('Log out') }}
                </p>
              </div>
            </div>
          </a>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pages.index')">{{ __('Pages') }}</x-nav-link>
                    <x-nav-link :href="route('events.index')">{{ __('Events') }}</x-nav-link>
                    <x-nav-link>{{ __('Users') }}</x-nav-link>
                    <x-nav-link :href="route('memberships.index')">{{ __('Memberships') }}</x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
 --}}
