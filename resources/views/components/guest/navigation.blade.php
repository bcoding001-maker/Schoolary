<!-- Navigation -->
<nav x-data="{ mobileMenuOpen: false }" class="fixed w-full z-50 glass-nav">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
        <div class="flex items-center justify-between py-2 sm:py-2.5 lg:py-3">
            <!-- Logo dan nama sekolah di pojok kiri (vertikal) -->
            <div class="flex flex-col items-center space-y-0.5 sm:space-y-1">
                <img class="h-10 sm:h-12 lg:h-14 w-auto drop-shadow-lg" src="{{ asset('assets/img/logo.png') }}" alt="Schoolary Logo">
                <div class="flex flex-col items-center text-center">
                    <!-- <span class="text-[10px] sm:text-xs lg:text-sm font-bold text-white drop-shadow-lg leading-tight whitespace-nowrap">School4ry</span> -->
                    <!-- <span class="text-[8px] sm:text-[10px] lg:text-xs text-white/90 drop-shadow-md">NEBRAZKA</span> -->
                </div>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <a href="#beranda" class="nav-link px-3 py-2 text-sm font-medium transition-all duration-300 hover:scale-105" id="nav-beranda">Beranda</a>
                    <a href="#galeri" class="nav-link px-3 py-2 text-sm font-medium transition-all duration-300 hover:scale-105" id="nav-galeri">Galeri</a>
                    <a href="#berita-agenda" class="nav-link px-3 py-2 text-sm font-medium transition-all duration-300 hover:scale-105" id="nav-berita">Berita & Agenda</a>
                    <a href="#kontak" class="nav-link px-3 py-2 text-sm font-medium transition-all duration-300 hover:scale-105" id="nav-kontak">Kontak</a>
                </div>

                @if (Route::has('login'))
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="ml-2">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-full shadow-sm transition-all duration-300">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-full shadow-sm transition-all duration-300">
                            Login
                        </a>
                    @endauth
                @endif
            </div>
            
            <!-- Mobile Hamburger Button -->
            <div class="lg:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="p-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 active:scale-95">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileMenuOpen = false"
             class="lg:hidden pb-3 pt-2 space-y-1">
            <a href="#beranda" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-white text-sm font-medium hover:bg-white/10 rounded-lg transition-all duration-300">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Beranda</span>
                </div>
            </a>
            <a href="#galeri" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-white text-sm font-medium hover:bg-white/10 rounded-lg transition-all duration-300">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Galeri</span>
                </div>
            </a>
            <a href="#berita-agenda" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-white text-sm font-medium hover:bg-white/10 rounded-lg transition-all duration-300">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <span>Berita</span>
                </div>
            </a>
            <a href="#kontak" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-white text-sm font-medium hover:bg-white/10 rounded-lg transition-all duration-300">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Kontak</span>
                </div>
            </a>
            @if (Route::has('login'))
                <div class="pt-2 mt-2 border-t border-white/20">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="mx-2">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2.5 bg-gradient-to-r from-slate-600 to-blue-500 text-white text-sm font-medium rounded-lg text-center shadow-lg">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block mx-2 px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg text-center transition-all duration-300">
                            Login
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>
