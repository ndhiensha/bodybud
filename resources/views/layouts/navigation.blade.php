<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left Side -->
            <div class="flex items-center space-x-6">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </Sa>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">

                <!-- SHOW WHEN NOT LOGGED IN -->
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 transition">
                        Sign Up
                    </a>
                @endguest

                <!-- SHOW WHEN LOGGED IN -->
                @auth
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.47a.75.75 0 111.04 1.08l-4.23 4a.75.75 0 01-1.04 0l-4.23-4a.75.75 0 01-.02-1.06z"
                                            clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    Profile
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Log Out
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endauth


                <!-- Hamburger (mobile) -->
                <div class="sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:bg-gray-200">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor">
                            <path :class="{'hidden': open, 'block': !open}" class="block"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'block': open}" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>
</nav>
