<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

        @livewireStyles
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
        @stack("styles")
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{route('dashboard')}}">
                                    <x-jet-application-mark class="block h-9 w-auto" />
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-jet-nav-link href="{{route('dashboard')}}" :active="request()->routeIs('dashboard')">
                                    Dashboard
                                </x-jet-nav-link>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="" />
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <x-jet-dropdown-link href="/user/profile">
                                        Profile
                                    </x-jet-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="/user/api-tokens">
                                            API Tokens
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <x-jet-dropdown-link href="/teams/{{ Auth::user()->currentTeam->id }}">
                                            Team Settings
                                        </x-jet-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-jet-dropdown-link href="/teams/create">
                                                Create New Team
                                            </x-jet-dropdown-link>
                                        @endcan

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-jet-switchable-team :team="$team" />
                                        @endforeach

                                        <div class="border-t border-gray-100"></div>
                                    @endif

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                     this.closest('form').submit();">
                                            Logout
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
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
                        <x-jet-responsive-nav-link href="/dashboard" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="" />
                            </div>

                            <div class="ml-3">
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-jet-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile.show')">
                                Profile
                            </x-jet-responsive-nav-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-responsive-nav-link href="/user/api-tokens" :active="request()->routeIs('api-tokens.index')">
                                    API Tokens
                                </x-jet-responsive-nav-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                    Logout
                                </x-jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <x-jet-responsive-nav-link href="/teams/{{ Auth::user()->currentTeam->id }}" :active="request()->routeIs('teams.show')">
                                    Team Settings
                                </x-jet-responsive-nav-link>

                                <x-jet-responsive-nav-link href="/teams/create" :active="request()->routeIs('teams.create')">
                                    Create New Team
                                </x-jet-responsive-nav-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @if (isset($header))
                        {{ $header }}
                        @else
                        <h2>Component Page</h2>
                    @endif
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12 grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:visible lg:visible xl:visible w-full md:col-span-2 mx-auto sm:px-2 lg:px-2 mb-2">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="p-4">
                                @if(isset($sidebar))
                                {{ $sidebar }}
                                @else
                                    <ul>
                                        <li class="py-4 px-4 border-b border-b-bg-blue-100">
                                            <a href="{{route('dashboard')}}">Dashboard</a>
                                        </li>
                                        <li class="py-4 px-4 border-b border-b-bg-blue-100">
                                            <a href="{{route('article.index')}}">Articles</a>
                                        </li>

                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto col-span-12  w-full md:col-span-10 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        @stack('scripts')

        @livewireScripts
    </body>
</html>
