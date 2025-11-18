<nav x-data="{ open: false }" class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
        <div class="flex items-center justify-between h-14 sm:h-16">
            <!-- Logo di Pojok Kiri -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="group block">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="SMKN 4 Bogor" class="h-9 sm:h-10 lg:h-12 w-auto transform transition-all duration-300 group-hover:scale-110 drop-shadow-md">
                </a>
            </div>

            <!-- Desktop Navigation Links di Tengah -->
            <div class="hidden lg:flex lg:items-center lg:space-x-4 xl:space-x-6 flex-1 justify-center">
                    <!-- Dashboard -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>{{ __('Dashboard') }}</span>
                        </div>
                    </x-nav-link>
                    
                    <!-- Berita -->
                    <x-nav-link :href="route('admin.berita.index')" :active="request()->routeIs('admin.berita.*')">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                            </svg>
                            <span>{{ __('Berita') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Agenda -->
                    <x-nav-link :href="route('admin.agenda.index')" :active="request()->routeIs('admin.agenda.*')">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ __('Agenda') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Gallery -->
                    <x-nav-link :href="route('admin.album.index')" :active="request()->routeIs('admin.album.*')">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ __('Gallery') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Laporan Foto -->
                    <x-nav-link :href="route('admin.photo.report')" :active="request()->routeIs('admin.photo.report')">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h8m-6 8V9a2 2 0 012-2h4m-8 10H5a2 2 0 01-2-2V7a2 2 0 012-2h4" />
                            </svg>
                            <span>{{ __('Laporan Foto') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Kategori -->
                    <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h.01M3 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span>{{ __('Kategori') }}</span>
                        </div>
                    </x-nav-link>

                    <!-- Management Admin (hanya untuk admin) -->
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.management')" :active="request()->routeIs('admin.management')">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>{{ __('Management Admin') }}</span>
                            </div>
                        </x-nav-link>
                    @endif
            </div>

            <!-- User Menu di Kanan -->
            <div class="hidden lg:flex lg:items-center flex-shrink-0 ml-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-200 dark:border-gray-600 text-sm leading-4 font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-all duration-150 group shadow-sm">
                            <div class="flex items-center min-w-0">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center text-white font-bold mr-2 flex-shrink-0">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden xl:block truncate max-w-[120px]">{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ml-1 flex-shrink-0">
                                <svg class="fill-current h-4 w-4 transform group-hover:rotate-180 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-600">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Signed in as</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="group">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ __('Profile') }}
                            </div>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="group">
                                <div class="flex items-center text-red-500 group-hover:text-red-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    {{ __('Log Out') }}
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Tombol Menu Mobile -->
            <div class="flex items-center gap-2 lg:hidden ml-auto">
                <button @click="open = !open" 
                        class="inline-flex items-center justify-center p-2.5 rounded-lg text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-150 active:scale-95">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" 
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" 
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="lg:hidden border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="py-3 space-y-1 px-3">
            <!-- Dashboard -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>

            <!-- Berita -->
            <x-responsive-nav-link :href="route('admin.berita.index')" :active="request()->routeIs('admin.berita.*')"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                </svg>
                <span>{{ __('Berita') }}</span>
            </x-responsive-nav-link>

            <!-- Agenda -->
            <x-responsive-nav-link :href="route('admin.agenda.index')" :active="request()->routeIs('admin.agenda.*')"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ __('Agenda') }}</span>
            </x-responsive-nav-link>

            <!-- Gallery -->
            <x-responsive-nav-link :href="route('admin.album.index')" :active="request()->routeIs('admin.album.*')"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ __('Gallery') }}</span>
            </x-responsive-nav-link>

            <!-- Laporan Foto -->
            <x-responsive-nav-link :href="route('admin.photo.report')" :active="request()->routeIs('admin.photo.report')"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h8m-6 8V9a2 2 0 012-2h4m-8 10H5a2 2 0 01-2-2V7a2 2 0 012-2h4" />
                </svg>
                <span>{{ __('Laporan Foto') }}</span>
            </x-responsive-nav-link>

            <!-- Kategori -->
            <x-responsive-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')"
                class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h.01M3 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span>{{ __('Kategori') }}</span>
            </x-responsive-nav-link>

            <!-- Management Admin (hanya untuk admin) -->
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.management')" :active="request()->routeIs('admin.management')"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>{{ __('Management Admin') }}</span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile User Menu -->
        <div class="pt-3 pb-3 border-t border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-900/50">
            <div class="px-3 flex items-center py-3">
                <div class="w-11 h-11 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="ml-3 flex-1 min-w-0">
                    <div class="font-semibold text-base text-gray-900 dark:text-gray-100 truncate">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-600 dark:text-gray-400 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-2 space-y-1 px-3">
                <!-- Mobile User Links -->
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

