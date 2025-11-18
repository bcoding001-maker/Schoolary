<!-- Galeri Section - Instagram Style -->
<section id="galeri" class="section-spacing relative overflow-hidden bg-gradient-to-b from-gray-50 to-white">
    <div class="absolute inset-0 bg-pattern opacity-30"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-3">
                Galeri Sekolah
            </h2>
            <p class="text-gray-600 text-base max-w-2xl mx-auto mb-4">
                Jelajahi momen-momen berharga dan kegiatan sekolah kami
            </p>
            <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
        </div>

        <!-- Instagram-Style Search Bar -->
        <div class="max-w-2xl mx-auto mb-8">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-300"></div>
                <div class="relative">
                    <input type="text" 
                        id="albumSearch"
                        placeholder="🔍 Cari album atau kategori..."
                        class="w-full px-6 py-4 rounded-2xl bg-white border-2 border-gray-200 
                            text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500
                            transition-all duration-300 shadow-lg hover:shadow-xl">
                    <div class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instagram-Style Category Pills -->
        <div class="mb-12 overflow-x-auto pb-4 scrollbar-hide">
            <div class="flex justify-center gap-3 min-w-max px-4">
                <!-- All Albums Tab -->
                <button onclick="showGalleryCategory('all-albums')"
                    class="gallery-category-tab group relative px-6 py-3 rounded-full text-sm font-semibold
                        bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg
                        hover:shadow-xl hover:scale-105 transition-all duration-300 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Semua Album
                        <span class="ml-1 px-2.5 py-0.5 text-xs bg-white/20 backdrop-blur-sm rounded-full font-bold">
                            {{ $allAlbums->count() }}
                        </span>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>

                @foreach($kategoris as $kategori)
                    <button onclick="showGalleryCategory('gallery-{{ $kategori->kategori_id }}')"
                        class="gallery-category-tab group relative px-6 py-3 rounded-full text-sm font-semibold
                            bg-white text-gray-700 border-2 border-gray-200 shadow-md
                            hover:border-blue-500 hover:text-blue-600 hover:shadow-lg hover:scale-105 
                            transition-all duration-300">
                        <span class="flex items-center gap-2">
                            {{ $kategori->kategori_judul }}
                            <span class="px-2.5 py-0.5 text-xs bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full font-bold">
                                {{ $kategori->albums->count() }}
                            </span>
                        </span>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Gallery Content Container -->
        <div class="gallery-content">
            <!-- All Albums Section -->
            <div id="all-albums" class="gallery-category-content">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($allAlbums as $album)
                        @include('components.album-card', ['album' => $album])
                    @endforeach
                </div>
            </div>

            <!-- Category Sections -->
            @foreach($kategoris as $kategori)
                <div id="gallery-{{ $kategori->kategori_id }}" class="gallery-category-content hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($kategori->albums as $album)
                            @include('components.album-card', ['album' => $album])
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Search Results Section -->
        <div id="search-results" class="hidden">
            <div class="mb-6 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800">Hasil Pencarian</h3>
                <button onclick="document.getElementById('albumSearch').value=''; searchAlbums();" 
                        class="text-sm text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Tutup
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Search results will be populated here -->
            </div>
        </div>

        <!-- Empty State (when no albums) -->
        @if($allAlbums->count() === 0)
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Album</h3>
                <p class="text-gray-600">Album galeri akan segera ditambahkan</p>
            </div>
        @endif
    </div>
</section>
