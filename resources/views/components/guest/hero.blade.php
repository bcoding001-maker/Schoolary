<!-- Hero Section -->
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
        <div class="relative w-full h-full flex transition-transform duration-700 ease-in-out"
             :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="min-w-full h-full flex-shrink-0 relative">
                    <div class="w-full h-full overflow-hidden">
                        <img :src="slide" 
                             :alt="'Slide ' + (index + 1)"
                             class="w-full h-full object-cover object-center animate-ken-burns"
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
        <div class="absolute bottom-6 sm:bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex gap-1.5 sm:gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="goToSlide(index)"
                        :class="currentSlide === index ? 'bg-white w-6 sm:w-8' : 'bg-white/40 w-1.5 sm:w-2 hover:bg-white/60'"
                        class="h-1.5 sm:h-2 rounded-full transition-all duration-300">
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
