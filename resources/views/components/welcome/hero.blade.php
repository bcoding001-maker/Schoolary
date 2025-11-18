<section id="beranda" class="min-h-screen flex items-center justify-center relative overflow-hidden" 
         x-data="{ 
             currentSlide: 0, 
             slides: ['{{ asset('assets/img/slider/slide-1.jpg') }}', '{{ asset('assets/img/slider/slide-2.jpg') }}'],
             direction: 'next',
             autoplayInterval: null,
             nextSlide() {
                 this.direction = 'next';
                 this.currentSlide = (this.currentSlide + 1) % this.slides.length;
             },
             prevSlide() {
                 this.direction = 'prev';
                 this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
             },
             goToSlide(index) {
                 this.direction = index > this.currentSlide ? 'next' : 'prev';
                 this.currentSlide = index;
             }
         }" 
         x-init="autoplayInterval = setInterval(() => { nextSlide() }, 4000)">
    
    <!-- Background Slider dengan animasi horizontal -->
    <div class="absolute inset-0 w-full h-full overflow-hidden">
        <!-- Slide Container dengan transform -->
        <div class="relative w-full h-full flex transition-transform duration-700 ease-out"
             :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="min-w-full h-full flex-shrink-0 relative hero-slide"
                     :class="currentSlide === index ? 'hero-slide-active' : 'hero-slide-inactive'">
                    <div class="w-full h-full overflow-hidden">
                        <img :src="slide" 
                             :alt="'Slide ' + (index + 1)"
                             class="w-full h-full object-cover object-center animate-ken-burns hero-slide-image"
                             style="filter: brightness(1.1) contrast(1.05);">
                    </div>
                </div>
            </template>
        </div>
        
        <!-- Overlay dengan gradient yang lebih terang -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/35 via-black/15 to-black/45 pointer-events-none"></div>
        
        <!-- Previous Button -->
        <button @click="prevSlide()" 
                class="absolute left-3 sm:left-4 md:left-6 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/20 backdrop-blur-sm p-2 sm:p-2.5 md:p-3 rounded-full transition-all duration-300 group hover:scale-105 active:scale-95">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-white transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <!-- Next Button -->
        <button @click="nextSlide()" 
                class="absolute right-3 sm:right-4 md:right-6 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/20 backdrop-blur-sm p-2 sm:p-2.5 md:p-3 rounded-full transition-all duration-300 group hover:scale-105 active:scale-95">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-white transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        
        <!-- Slider Navigation Dots (Modern & Minimal) -->
        <div class="absolute bottom-6 sm:bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex gap-1 sm:gap-1.5">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="goToSlide(index)"
                        :class="currentSlide === index ? 'bg-white w-1.5 sm:w-2' : 'bg-white/40 w-1 sm:w-1 hover:bg-white/60'"
                        class="h-0.5 sm:h-1.5 rounded-full transition-all duration-300">
                </button>
            </template>
        </div>
    </div>

    <!-- Content dengan animasi -->
    <div class="relative z-10 text-center px-4 sm:px-6 max-w-5xl mx-auto">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 sm:mb-8 text-white drop-shadow-lg animate-slide-up opacity-0 leading-tight"
            style="animation-delay: 300ms;">
            SMK NEGERI 4 BOGOR
        </h1>
        <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-200 mb-8 sm:mb-12 drop-shadow-md animate-slide-up opacity-0 px-4"
           style="animation-delay: 600ms;">
            Membentuk Generasi Unggul dan Berakhlak Mulia
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6 animate-slide-up opacity-0"
             style="animation-delay: 900ms;">
            <a href="#profil" 
               class="elegant-button px-6 sm:px-8 py-2.5 sm:py-3 rounded-full text-white text-base sm:text-lg font-medium shadow-lg hover:scale-110 transition-all duration-300 w-full sm:w-auto max-w-[200px]">
                Jelajahi
            </a>
            <a href="#kontak" 
               class="glass-card px-6 sm:px-8 py-2.5 sm:py-3 rounded-full text-white text-base sm:text-lg font-medium 
                      hover:bg-white/20 hover:scale-110 transition-all duration-300 w-full sm:w-auto max-w-[200px]">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

<!-- Program Unggulan Section -->
<section class="section-spacing relative overflow-hidden bg-gradient-to-b from-white to-gray-50">
    <div class="absolute inset-0 bg-pattern opacity-30"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold gallery-title-gradient mb-4">Kejuruan</h2>
            <div class="w-24 h-1 gallery-underline mx-auto rounded-full"></div>
            <p class="text-gray-800 mt-4">Program Keahlian yang Siap Mencetak Generasi Unggul dan Profesional</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <!-- PPLG Card -->
            <div class="relative glass-card rounded-2xl p-4 hover-lift group overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                <div class="absolute inset-[2px] bg-white rounded-2xl"></div>
                
                <div class="relative z-10">
                    <div class="h-32 mb-4 rounded-xl overflow-hidden bg-white flex items-center justify-center p-2">
                        <img src="{{ asset('assets/img/logo_pplg.png') }}" alt="PPLG" 
                             class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="text-indigo-500 mb-3 flex justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-indigo-700 mb-2 text-center">PPLG</h3>
                    <h4 class="text-xs text-indigo-600 mb-3 text-center leading-tight">Pengembangan Perangkat Lunak dan Gim</h4>
                    <p class="text-gray-700 text-xs leading-relaxed text-center">
                        Program keahlian yang fokus pada pengembangan aplikasi, website, dan game dengan teknologi terkini. 
                        Lulusan siap menjadi developer profesional di industri teknologi.
                    </p>
                </div>
            </div>

            <!-- TJKT Card -->
            <div class="relative glass-card rounded-2xl p-4 hover-lift group overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                <div class="absolute inset-[2px] bg-white rounded-2xl"></div>
                <div class="relative z-10">
                    <div class="h-32 mb-4 rounded-xl overflow-hidden bg-white flex items-center justify-center p-2">
                        <img src="{{ asset('assets/img/logo_tjkt.png') }}" alt="TJKT" 
                             class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="text-purple-500 mb-3 flex justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-purple-700 mb-2 text-center">TJKT</h3>
                    <h4 class="text-xs text-purple-600 mb-3 text-center leading-tight">Teknik Jaringan Komputer dan Telekomunikasi</h4>
                    <p class="text-gray-700 text-xs leading-relaxed text-center">
                        Membekali siswa dengan keahlian dalam instalasi jaringan, keamanan sistem, dan manajemen infrastruktur IT modern.
                    </p>
                </div>
            </div>

            <!-- TO Card -->
            <div class="relative glass-card rounded-2xl p-4 hover-lift group overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-rose-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                <div class="absolute inset-[2px] bg-white rounded-2xl"></div>
                <div class="relative z-10">
                    <div class="h-32 mb-4 rounded-xl overflow-hidden bg-white flex items-center justify-center p-2">
                        <img src="{{ asset('assets/img/logo_to.png') }}" alt="TO" 
                             class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="text-pink-500 mb-3 flex justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-pink-700 mb-2 text-center">TO</h3>
                    <h4 class="text-xs text-pink-600 mb-3 text-center leading-tight">Teknik Otomotif</h4>
                    <p class="text-gray-700 text-xs leading-relaxed text-center">
                        Program keahlian yang mempelajari teknologi kendaraan modern, sistem kelistrikan, dan perawatan mesin dengan standar industri.
                    </p>
                </div>
            </div>

            <!-- TFL Card -->
            <div class="relative glass-card rounded-2xl p-4 hover-lift group overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                <div class="absolute inset-[2px] bg-white rounded-2xl"></div>
                <div class="relative z-10">
                    <div class="h-32 mb-4 rounded-xl overflow-hidden bg-white flex items-center justify-center p-2">
                        <img src="{{ asset('assets/img/logo_tfl.png') }}" alt="TFL" 
                             class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="text-emerald-500 mb-3 flex justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-emerald-700 mb-2 text-center">TFL</h3>
                    <h4 class="text-xs text-emerald-600 mb-3 text-center leading-tight">Teknik Fabrikasi Logam dan Manufaktur</h4>
                    <p class="text-gray-700 text-xs leading-relaxed text-center">
                        Mempersiapkan siswa dalam bidang pengolahan logam, pengelasan, dan manufaktur dengan teknologi modern untuk industri.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-12">
            <a href="#kontak" class="elegant-button inline-flex items-center px-8 py-3 rounded-full text-white text-lg font-medium shadow-lg group">
                <span>Daftar Sekarang</span>
                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
</section>
