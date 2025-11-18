    <script>
        // Global auth state for guest interactions
        window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        window.loginUrl = '{{ route('login') }}';
        window.registerUrl = '{{ route('register') }}';
    </script>

    <script>
        // Scroll to top functionality
        const scrollButton = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', () => {
            scrollButton.style.opacity = window.scrollY > 500 ? '1' : '0';
        });

        scrollButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-in-out'
        });
    </script>
    <script>

        // Navbar Animation on Scroll
        const navbar = document.querySelector('nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth Scroll dengan easing dan aktifkan underline menu
        function setActiveNav(sectionId) {
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            if (sectionId === 'beranda') document.getElementById('nav-beranda').classList.add('active');
            if (sectionId === 'profil') document.getElementById('nav-profil').classList.add('active');
            if (sectionId === 'galeri') document.getElementById('nav-galeri').classList.add('active');
            if (sectionId === 'berita-agenda') document.getElementById('nav-berita').classList.add('active');
            if (sectionId === 'kontak') document.getElementById('nav-kontak').classList.add('active');
        }

        document.querySelectorAll('.nav-link[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                const offset = 80; // Adjust based on navbar height
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                setActiveNav(this.getAttribute('href').replace('#',''));
            });
        });

        // Aktifkan menu sesuai section saat scroll
        window.addEventListener('scroll', () => {
            const sections = ['beranda','profil','galeri','berita-agenda','kontak'];
            let current = 'beranda';
            for (const id of sections) {
                const el = document.getElementById(id);
                if (el && window.scrollY + 100 >= el.offsetTop) {
                    current = id;
                }
            }
            setActiveNav(current);
        });

        // Intersection Observer untuk animasi scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all sections
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>
    <script>
        async function showBeritaPreview(beritaId) {
            const modal = document.getElementById('beritaPreviewModal');
            const title = document.getElementById('beritaPreviewTitle');
            const content = document.getElementById('beritaPreviewContent');
            
            try {
                const response = await fetch(`/preview-berita/${beritaId}`);
                const data = await response.json();
                
                title.textContent = data.judul;
                
                let contentHtml = `
                    <div class="space-y-6">
                        ${data.thumbnail ? `
                            <div class="relative h-[300px] rounded-xl overflow-hidden">
                                <img src="/storage/berita/${data.thumbnail}" 
                                     alt="${data.judul}"
                                     class="w-full h-full object-cover">
                            </div>
                        ` : ''}
                        
                        <div class="flex items-center space-x-4 text-gray-400 text-sm">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                ${new Date(data.created_at).toLocaleDateString('id-ID', { 
                                    day: 'numeric', 
                                    month: 'long', 
                                    year: 'numeric'
                                })}
                            </span>
                            ${data.user ? `
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                ${data.user.name}
                            </span>
                        ` : ''}
                        </div>
                        
                        <div class="prose prose-invert max-w-none">
                            ${data.konten}
                        </div>
                    </div>
                `;
                
                content.innerHTML = contentHtml;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
            } catch (error) {
                console.error('Error fetching berita:', error);
            }
        }

        function closeBeritaPreview() {
            const modal = document.getElementById('beritaPreviewModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBeritaPreview();
            }
        });
    </script>

    <!-- Album View Modal -->
    <div id="albumViewModal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
            <div class="fixed inset-0 bg-white/80 transition-opacity"></div>
            <!-- Modal Content -->
            <div class="inline-block w-full max-w-6xl mt-24 mb-8 text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl border border-gray-200 relative z-[70] max-h-[85vh] flex flex-col">
                <div class="relative p-6 flex-shrink-0">
                    <!-- Tombol Tutup -->
                    <button onclick="closeAlbumView()" class="absolute top-4 right-4 z-[80] text-gray-500 hover:text-gray-700 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <!-- Judul Album & Breadcrumb -->
                    <h2 id="albumViewTitle" class="text-2xl font-bold text-gray-800 mb-2"></h2>
                    <p id="albumBreadcrumb" class="text-gray-500 mb-4"></p>
                    
                    <!-- Toolbar: Sort, Filter, View Mode -->
                    <div id="photoToolbar" class="hidden mb-4 p-4 bg-gradient-to-r from-slate-50 to-blue-50 rounded-xl border border-slate-200">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <!-- Left Side: Sort & Filter -->
                            <div class="flex flex-wrap items-center gap-3">
                                <!-- Sort By -->
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                                    </svg>
                                    <select id="sortBy" onchange="applySortAndFilter()" 
                                            class="px-3 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                        <option value="newest">ðŸ“… Terbaru</option>
                                        <option value="oldest">ðŸ“… Terlama</option>
                                        <option value="most_liked">â¤ï¸ Paling Disukai</option>
                                        <option value="most_viewed">ðŸ‘ï¸ Paling Dilihat</option>
                                    </select>
                                </div>

                                <!-- Filter By Date -->
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                    <select id="filterBy" onchange="applySortAndFilter()" 
                                            class="px-3 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                        <option value="all">ðŸ• Semua Waktu</option>
                                        <option value="today">ðŸ“† Hari Ini</option>
                                        <option value="week">ðŸ“… Minggu Ini</option>
                                        <option value="month">ðŸ“… Bulan Ini</option>
                                        <option value="year">ðŸ“… Tahun Ini</option>
                                    </select>
                                </div>

                                <!-- Photo Count -->
                                <div class="px-3 py-2 bg-blue-100 text-blue-700 text-sm font-semibold rounded-lg">
                                    <span id="photoCount">0</span> Foto
                                </div>
                            </div>

                            <!-- Right Side: View Mode -->
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-slate-600 font-medium">Tampilan:</span>
                                <div class="flex bg-white border border-slate-300 rounded-lg overflow-hidden">
                                    <button onclick="changeViewMode('grid')" id="viewModeGrid" 
                                            class="view-mode-btn active px-3 py-2 text-slate-700 hover:bg-slate-100 transition-colors border-r border-slate-300"
                                            title="Grid View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                        </svg>
                                    </button>
                                    <button onclick="changeViewMode('masonry')" id="viewModeMasonry" 
                                            class="view-mode-btn px-3 py-2 text-slate-700 hover:bg-slate-100 transition-colors border-r border-slate-300"
                                            title="Masonry View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/>
                                        </svg>
                                    </button>
                                    <button onclick="changeViewMode('list')" id="viewModeList" 
                                            class="view-mode-btn px-3 py-2 text-slate-700 hover:bg-slate-100 transition-colors"
                                            title="List View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Album - Scrollable Area -->
                <div class="flex-1 overflow-y-auto px-6 pb-6">
                    <div id="albumViewContent" class="space-y-8 flex flex-col items-center">
                        <!-- Konten akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo View Modal -->
    <div id="photoViewModal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
        <div class="min-h-screen flex items-center justify-center px-4 py-8">
            <div class="fixed inset-0 bg-black/80 transition-opacity"></div>
            <div class="relative max-w-6xl w-full z-[70]">
                <!-- Tombol Tutup -->
                <button onclick="closePhotoView()" class="absolute -top-12 right-0 z-[80] text-white hover:text-gray-300 bg-black/50 rounded-full p-2 shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <!-- Konten Foto -->
                <div id="photoViewContent" class="text-gray-800 bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
                    <!-- Konten akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan album berdasarkan kategori dengan animasi smooth
        function showGalleryCategory(categoryId) {
            // Sembunyikan semua konten kategori
            const allContents = document.querySelectorAll('.gallery-category-content');
            allContents.forEach(content => {
                content.classList.add('hidden');
            });

            // Tampilkan konten kategori yang dipilih dengan animasi
            const selectedContent = document.getElementById(categoryId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
                // Trigger reflow untuk animasi
                selectedContent.style.animation = 'none';
                setTimeout(() => {
                    selectedContent.style.animation = '';
                }, 10);
            }

            // Update active state pada category tabs
            const allTabs = document.querySelectorAll('.gallery-category-tab');
            allTabs.forEach(tab => {
                tab.classList.remove('active');
            });

            // Aktifkan tab yang dipilih
            const activeTab = document.querySelector(`[onclick="showGalleryCategory('${categoryId}')"]`);
            if (activeTab) {
                activeTab.classList.add('active');
                
                // Smooth scroll ke tab yang aktif (untuk mobile)
                activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }

            // Reset search jika ada
            const searchInput = document.getElementById('albumSearch');
            if (searchInput && searchInput.value) {
                searchInput.value = '';
                const searchResults = document.getElementById('search-results');
                const galleryContent = document.querySelector('.gallery-content');
                if (searchResults) searchResults.classList.add('hidden');
                if (galleryContent) galleryContent.classList.remove('hidden');
            }
        }

        // Tampilkan semua album saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            showGalleryCategory('all-albums');
        });
    </script>

    <script>
        // Fungsi pencarian album
        function searchAlbums() {
            const searchInput = document.getElementById('albumSearch');
            const searchQuery = searchInput.value.toLowerCase().trim();
            const searchResults = document.getElementById('search-results');
            const galleryContent = document.querySelector('.gallery-content');
            
            // Jika search query kosong, tampilkan kembali gallery content
            if (searchQuery === '') {
                searchResults.classList.add('hidden');
                galleryContent.classList.remove('hidden');
                return;
            }

            // Sembunyikan gallery content dan tampilkan search results
            galleryContent.classList.add('hidden');
            searchResults.classList.remove('hidden');

            // Clear previous search results
            const searchResultsGrid = searchResults.querySelector('.grid');
            searchResultsGrid.innerHTML = '';

            // Get all album cards ONLY from "all-albums" section to avoid duplicates
            const allAlbumCards = document.querySelectorAll('#all-albums > .grid > div');
            
            // Filter dan tampilkan hasil pencarian
            let found = false;
            const addedAlbums = new Set(); // Track added albums to prevent duplicates
            
            allAlbumCards.forEach(card => {
                // Get album ID from onclick attribute to check for duplicates
                const onclickAttr = card.getAttribute('onclick');
                const albumId = onclickAttr ? onclickAttr.match(/viewAlbum\('(\d+)'\)/)?.[1] : null;
                
                // Skip if already added
                if (albumId && addedAlbums.has(albumId)) {
                    return;
                }
                
                // Get album name from h3 tag
                const albumNameElement = card.querySelector('h3');
                const albumName = albumNameElement ? albumNameElement.textContent.toLowerCase() : '';
                
                // Get category from span with rounded-full class
                const categoryElement = card.querySelector('.rounded-full');
                const albumCategory = categoryElement ? categoryElement.textContent.toLowerCase() : '';
                
                // Get description from p tag
                const descriptionElement = card.querySelector('p.text-gray-300');
                const albumDescription = descriptionElement ? descriptionElement.textContent.toLowerCase() : '';

                // Check if search query matches
                if (albumName.includes(searchQuery) || 
                    albumCategory.includes(searchQuery) || 
                    albumDescription.includes(searchQuery)) {
                    
                    // Clone the card and append to search results
                    const clonedCard = card.cloneNode(true);
                    searchResultsGrid.appendChild(clonedCard);
                    
                    // Mark this album as added
                    if (albumId) {
                        addedAlbums.add(albumId);
                    }
                    
                    found = true;
                }
            });

            // Tampilkan pesan jika tidak ada hasil
            if (!found) {
                searchResultsGrid.innerHTML = `
                    <div class="col-span-full text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">Tidak ada hasil</h3>
                        <p class="text-gray-400">Tidak ditemukan album yang sesuai dengan pencarian "<span class="font-semibold">${searchQuery}</span>"</p>
                    </div>
                `;
            }
        }

        // Event listener untuk input pencarian (pastikan DOM sudah loaded)
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('albumSearch');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(searchAlbums, 300));
                console.log('Album search initialized');
            } else {
                console.error('Album search input not found');
            }
        });

        // Fungsi debounce untuk mengurangi frekuensi pencarian
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Reset pencarian saat kategori diganti
        function showGalleryCategory(categoryId) {
            // Reset search input
            document.getElementById('albumSearch').value = '';
            
            // Hide search results
            document.getElementById('search-results').classList.add('hidden');
            document.querySelector('.gallery-content').classList.remove('hidden');

            // Original category switching logic
            const allContents = document.querySelectorAll('.gallery-category-content');
            allContents.forEach(content => {
                content.classList.add('hidden');
            });

            const selectedContent = document.getElementById(categoryId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }

            // Update active tab styles
            const allTabs = document.querySelectorAll('.gallery-category-tab');
            allTabs.forEach(tab => {
                tab.classList.remove('from-indigo-500', 'to-purple-500');
                tab.classList.add('from-indigo-500/50', 'to-purple-500/50');
            });

            const activeTab = document.querySelector(`[onclick="showGalleryCategory('${categoryId}')"]`);
            if (activeTab) {
                activeTab.classList.remove('from-indigo-500/50', 'to-purple-500/50');
                activeTab.classList.add('from-indigo-500', 'to-purple-500');
            }
        }
    </script>

    <script>
        async function viewAlbum(albumId) {
            window.location.href = `/album/${albumId}`;
            return;
            const modal = document.getElementById('albumViewModal');
            const content = document.getElementById('albumViewContent');
            const title = document.getElementById('albumViewTitle');
            const breadcrumb = document.getElementById('albumBreadcrumb');
            
            try {
                // Ganti URL dari /api/albums ke /view-album
                const response = await fetch(`/view-album/${albumId}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const result = await response.json();
                if (result.status === 'error') {
                    throw new Error(result.message);
                }
                
                const data = result.data;
                
                // Tampilkan modal dan isi kontennya
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Isi judul dan breadcrumb
                title.textContent = data.album_name;
                breadcrumb.innerHTML = `
                    <div class="flex items-center text-sm text-gray-400">
                        <span class="text-indigo-400">${data.kategori.kategori_judul}</span>
                        ${data.parent ? `
                            <span class="mx-2">/</span>
                            <span class="text-gray-400 cursor-pointer hover:text-white" 
                                  onclick="viewAlbum('${data.parent.album_id}')">
                                ${data.parent.album_name}
                            </span>
                        ` : ''}
                        <span class="mx-2">/</span>
                        <span class="text-white">${data.album_name}</span>
                    </div>
                `;

                // Isi konten album
                let contentHtml = '';
                
                // Tampilkan deskripsi jika ada
                if (data.description) {
                    contentHtml += `
                        <div class="bg-white/5 rounded-xl p-4 backdrop-blur-sm mb-6">
                            <p class="text-gray-300">${data.description}</p>
                        </div>
                    `;
                }

                // Tampilkan sub-album jika ada
                if (data.sub_albums && data.sub_albums.length > 0) {
                    contentHtml += `
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-white flex items-center mb-4">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Sub Album (${data.sub_albums.length})
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full max-w-4xl mx-auto">
                                ${data.sub_albums.map(subAlbum => `
                                    <div class="group relative bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden hover:bg-white/10 transition-all duration-300 cursor-pointer"
                                         onclick="viewAlbum('${subAlbum.album_id}')">
                                        <!-- Sub album content -->
                                        <div class="relative aspect-video">
                                            ${subAlbum.cover_image ? 
                                                `<img src="/storage/${subAlbum.cover_image}" 
                                                      alt="${subAlbum.album_name}"
                                                      class="w-full h-full object-cover transform group-hover:scale-110 transition-all duration-500">` :
                                                `<div class="w-full h-full bg-gradient-to-br from-indigo-500/30 to-purple-500/30 flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>`
                                            }
                                        </div>
                                        <div class="p-4">
                                            <h4 class="text-lg font-semibold text-white group-hover:text-indigo-300 transition-colors">
                                                ${subAlbum.album_name}
                                            </h4>
                                            ${subAlbum.description ? 
                                                `<p class="mt-1 text-sm text-gray-400 line-clamp-2">${subAlbum.description}</p>` : 
                                                ''}
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                }

                // Tampilkan foto-foto jika ada
                if (data.photos && data.photos.length > 0) {
                    contentHtml += `
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Foto (${data.photos.length})
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full max-w-5xl mx-auto">
                                ${data.photos.map(photo => `
                                    <div class="group bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                                        <!-- Image Container -->
                                        <div class="relative aspect-square overflow-hidden cursor-pointer"
                                             onclick="openPhotoModal(${photo.id}, '${photo.image_path}', '${photo.title}', '${photo.description || ''}', ${photo.likes_count}, ${photo.is_liked})">
                                            <img src="/storage/${photo.image_path}" 
                                                 alt="${photo.title}"
                                                 class="w-full h-full object-cover">
                                            
                                            <!-- Hover Overlay -->
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <div class="text-center text-white">
                                                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    <p class="text-sm font-medium">Lihat Detail</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Info Section (Instagram Style) -->
                                        <div class="p-3">
                                            <!-- Like & Actions -->
                                            <div class="flex items-center justify-between mb-2">
                                                <button onclick="event.stopPropagation(); toggleLike(${photo.id})" 
                                                        id="like-btn-${photo.id}"
                                                        class="flex items-center space-x-1 transition-all duration-300 hover:scale-110">
                                                    <svg id="like-icon-${photo.id}" class="w-6 h-6 transition-all ${photo.is_liked ? 'fill-red-500 text-red-500 scale-110' : 'text-gray-700'}" 
                                                         fill="${photo.is_liked ? 'currentColor' : 'none'}" 
                                                         stroke="currentColor" 
                                                         stroke-width="2"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                    </svg>
                                                </button>
                                                <div class="flex items-center space-x-3 text-gray-500 text-sm">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        ${photo.views_count || 0}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Likes Count -->
                                            <div class="mb-2">
                                                <span id="like-count-${photo.id}" class="text-sm font-semibold text-gray-900">${photo.likes_count} suka</span>
                                            </div>
                                            
                                            <!-- Title & Description -->
                                            <div>
                                                <h4 class="text-sm font-semibold text-gray-900 mb-1">${photo.title}</h4>
                                                ${photo.description ? 
                                                    `<p class="text-xs text-gray-600 line-clamp-2">${photo.description}</p>` 
                                                    : ''}
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                }

                // Tampilkan pesan jika album kosong
                if ((!data.photos || data.photos.length === 0) && (!data.sub_albums || data.sub_albums.length === 0)) {
                    contentHtml += `
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-400">Album ini masih kosong</p>
                        </div>
                    `;
                }

                content.innerHTML = contentHtml;
                
                // Store original photos data for sorting/filtering
                if (data.photos && data.photos.length > 0) {
                    window.currentPhotos = data.photos;
                    window.currentViewMode = 'grid';
                    
                    // Show toolbar
                    document.getElementById('photoToolbar').classList.remove('hidden');
                    document.getElementById('photoCount').textContent = data.photos.length;
                    
                    // Reset toolbar
                    document.getElementById('sortBy').value = 'newest';
                    document.getElementById('filterBy').value = 'all';
                } else {
                    window.currentPhotos = [];
                    document.getElementById('photoToolbar').classList.add('hidden');
                }
                
            } catch (error) {
                console.error('Error loading album:', error);
                alert('Gagal memuat album. Silakan coba lagi nanti.');
            }
        }

        // Global variables for sorting and filtering
        let currentPhotos = [];
        let currentViewMode = 'grid';

        // Function to apply sort and filter
        function applySortAndFilter() {
            if (!currentPhotos || currentPhotos.length === 0) return;
            
            const sortBy = document.getElementById('sortBy').value;
            const filterBy = document.getElementById('filterBy').value;
            
            // Clone photos array
            let filteredPhotos = [...currentPhotos];
            
            // Apply date filter
            const now = new Date();
            if (filterBy !== 'all') {
                filteredPhotos = filteredPhotos.filter(photo => {
                    const photoDate = new Date(photo.created_at);
                    
                    switch(filterBy) {
                        case 'today':
                            return photoDate.toDateString() === now.toDateString();
                        case 'week':
                            const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                            return photoDate >= weekAgo;
                        case 'month':
                            return photoDate.getMonth() === now.getMonth() && 
                                   photoDate.getFullYear() === now.getFullYear();
                        case 'year':
                            return photoDate.getFullYear() === now.getFullYear();
                        default:
                            return true;
                    }
                });
            }
            
            // Apply sorting
            filteredPhotos.sort((a, b) => {
                switch(sortBy) {
                    case 'newest':
                        return new Date(b.created_at) - new Date(a.created_at);
                    case 'oldest':
                        return new Date(a.created_at) - new Date(b.created_at);
                    case 'most_liked':
                        return b.likes_count - a.likes_count;
                    case 'most_viewed':
                        return b.views_count - a.views_count;
                    default:
                        return 0;
                }
            });
            
            // Update photo count
            document.getElementById('photoCount').textContent = filteredPhotos.length;
            
            // Render photos based on current view mode
            renderPhotos(filteredPhotos, currentViewMode);
        }

        // Function to change view mode
        function changeViewMode(mode) {
            currentViewMode = mode;
            
            // Update button states
            document.querySelectorAll('.view-mode-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.getElementById(`viewMode${mode.charAt(0).toUpperCase() + mode.slice(1)}`).classList.add('active');
            
            // Re-render photos
            applySortAndFilter();
        }

        // Function to render photos based on view mode
        function renderPhotos(photos, viewMode) {
            const container = document.querySelector('#albumViewContent .space-y-4');
            if (!container) return;
            
            let photosHtml = '';
            
            if (viewMode === 'grid') {
                // Grid View (4 columns)
                photosHtml = `
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Foto (${photos.length})
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        ${photos.map(photo => createPhotoCard(photo)).join('')}
                    </div>
                `;
            } else if (viewMode === 'masonry') {
                // Masonry View (Pinterest style)
                photosHtml = `
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Foto (${photos.length})
                    </h3>
                    <div class="masonry-grid">
                        ${photos.map(photo => createMasonryCard(photo)).join('')}
                    </div>
                `;
            } else if (viewMode === 'list') {
                // List View (with details)
                photosHtml = `
                    <h3 class="text-xl font-semibold text-white flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Foto (${photos.length})
                    </h3>
                    <div class="space-y-3">
                        ${photos.map(photo => createListCard(photo)).join('')}
                    </div>
                `;
            }
            
            container.innerHTML = photosHtml;
        }

        // Create photo card for grid view
        function createPhotoCard(photo) {
            return `
                <div class="group relative aspect-square rounded-xl overflow-hidden">
                    <img src="/storage/${photo.image_path}" 
                         alt="${photo.title}"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-all duration-500 cursor-pointer"
                         onclick="openPhotoModal(${photo.id}, '${photo.image_path}', '${photo.title}', '${photo.description || ''}', ${photo.likes_count}, ${photo.is_liked}); incrementPhotoView(${photo.id})">
                    
                    <!-- Like Button -->
                    <button onclick="event.stopPropagation(); toggleLike(${photo.id})" 
                            id="like-btn-${photo.id}"
                            class="absolute top-3 right-3 z-10 flex items-center space-x-1 px-3 py-1.5 rounded-full backdrop-blur-md transition-all duration-300 ${photo.is_liked ? 'bg-red-500/90 text-white' : 'bg-black/40 text-white hover:bg-black/60'}">
                        <svg id="like-icon-${photo.id}" class="w-5 h-5 transition-transform ${photo.is_liked ? 'fill-current' : ''}" 
                             fill="${photo.is_liked ? 'currentColor' : 'none'}" 
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span id="like-count-${photo.id}" class="text-sm font-semibold">${photo.likes_count}</span>
                    </button>

                    <!-- Views Counter -->
                    <div class="absolute top-3 left-3 z-10 flex items-center space-x-1 px-2 py-1 rounded-full bg-black/40 backdrop-blur-md text-white text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>${photo.views_count}</span>
                    </div>

                    <!-- Info Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                         onclick="openPhotoModal(${photo.id}, '${photo.image_path}', '${photo.title}', '${photo.description || ''}', ${photo.likes_count}, ${photo.is_liked}); incrementPhotoView(${photo.id})">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h4 class="text-white font-medium truncate">${photo.title}</h4>
                            ${photo.description ? 
                                `<p class="text-sm text-gray-300 line-clamp-2 mt-1">${photo.description}</p>` 
                                : ''}
                        </div>
                    </div>
                </div>
            `;
        }

        // Create masonry card
        function createMasonryCard(photo) {
            return `
                <div class="masonry-item group relative rounded-xl overflow-hidden cursor-pointer"
                     onclick="openPhotoModal(${photo.id}, '${photo.image_path}', '${photo.title}', '${photo.description || ''}', ${photo.likes_count}, ${photo.is_liked}); incrementPhotoView(${photo.id})">
                    <img src="/storage/${photo.image_path}" 
                         alt="${photo.title}"
                         class="w-full h-auto rounded-xl transform group-hover:scale-105 transition-all duration-500">
                    
                    <!-- Like & Views Overlay -->
                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                        <button onclick="event.stopPropagation(); toggleLike(${photo.id})" 
                                id="like-btn-${photo.id}"
                                class="flex items-center space-x-1 px-2 py-1 rounded-full backdrop-blur-md transition-all ${photo.is_liked ? 'bg-red-500/90' : 'bg-black/40 hover:bg-black/60'} text-white text-xs">
                            <svg id="like-icon-${photo.id}" class="w-4 h-4 ${photo.is_liked ? 'fill-current' : ''}" 
                                 fill="${photo.is_liked ? 'currentColor' : 'none'}" 
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span id="like-count-${photo.id}">${photo.likes_count}</span>
                        </button>
                        <div class="flex items-center space-x-1 px-2 py-1 rounded-full bg-black/40 backdrop-blur-md text-white text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>${photo.views_count}</span>
                        </div>
                    </div>
                    
                    <!-- Title Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/80 to-transparent">
                        <h4 class="text-white font-medium text-sm">${photo.title}</h4>
                    </div>
                </div>
            `;
        }

        // Create list card
        function createListCard(photo) {
            const date = new Date(photo.created_at).toLocaleDateString('id-ID', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            return `
                <div class="flex gap-4 p-4 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors cursor-pointer"
                     onclick="openPhotoModal(${photo.id}, '${photo.image_path}', '${photo.title}', '${photo.description || ''}', ${photo.likes_count}, ${photo.is_liked}); incrementPhotoView(${photo.id})">
                    <!-- Thumbnail -->
                    <div class="flex-shrink-0 w-32 h-32 rounded-lg overflow-hidden">
                        <img src="/storage/${photo.image_path}" 
                             alt="${photo.title}"
                             class="w-full h-full object-cover">
                    </div>
                    
                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <h4 class="text-lg font-semibold text-slate-800 mb-1">${photo.title}</h4>
                        ${photo.description ? 
                            `<p class="text-sm text-slate-600 line-clamp-2 mb-2">${photo.description}</p>` 
                            : ''}
                        <div class="flex items-center gap-4 text-sm text-slate-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                ${date}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 ${photo.is_liked ? 'fill-red-500 text-red-500' : ''}" fill="${photo.is_liked ? 'currentColor' : 'none'}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                ${photo.likes_count} Likes
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                ${photo.views_count} Views
                            </span>
                        </div>
                    </div>
                    
                    <!-- Like Button -->
                    <div class="flex-shrink-0">
                        <button onclick="event.stopPropagation(); toggleLike(${photo.id})" 
                                id="like-btn-${photo.id}"
                                class="p-3 rounded-full transition-all ${photo.is_liked ? 'bg-red-500 text-white' : 'bg-slate-200 text-slate-600 hover:bg-slate-300'}">
                            <svg id="like-icon-${photo.id}" class="w-6 h-6 ${photo.is_liked ? 'fill-current' : ''}" 
                                 fill="${photo.is_liked ? 'currentColor' : 'none'}" 
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
        }

        // Function to increment photo view
        async function incrementPhotoView(photoId) {
            try {
                await fetch(`/photo/${photoId}/view`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });
            } catch (error) {
                console.error('Error incrementing view:', error);
            }
        }

        // Fungsi untuk toggle like
        async function toggleLike(photoId) {
            // Jika belum login, arahkan ke halaman register user dengan redirect kembali ke halaman saat ini
            if (typeof window.isAuthenticated !== 'undefined' && !window.isAuthenticated) {
                const registerBase = window.registerUrl || '/register';
                const redirectUrl = encodeURIComponent(window.location.href);
                window.location.href = `${registerBase}?redirect=${redirectUrl}`;
                return;
            }

            const likeBtn = document.getElementById(`like-btn-${photoId}`);
            const likeIcon = document.getElementById(`like-icon-${photoId}`);
            const likeCount = document.getElementById(`like-count-${photoId}`);
            
            // Disable button sementara
            likeBtn.disabled = true;
            
            try {
                const response = await fetch(`/photo/${photoId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update UI
                    likeCount.textContent = data.likes_count;
                    
                    if (data.liked) {
                        // Liked - ubah ke merah
                        likeBtn.classList.remove('bg-black/40', 'hover:bg-black/60');
                        likeBtn.classList.add('bg-red-500/90');
                        likeIcon.setAttribute('fill', 'currentColor');
                        likeIcon.classList.add('fill-current');
                        
                        // Animasi bounce
                        likeIcon.classList.add('animate-bounce');
                        setTimeout(() => likeIcon.classList.remove('animate-bounce'), 500);
                    } else {
                        // Unliked - ubah ke hitam transparan
                        likeBtn.classList.remove('bg-red-500/90');
                        likeBtn.classList.add('bg-black/40', 'hover:bg-black/60');
                        likeIcon.setAttribute('fill', 'none');
                        likeIcon.classList.remove('fill-current');
                    }
                    
                    // Update modal jika ada
                    const modalLikeBtn = document.getElementById(`modal-like-btn-${photoId}`);
                    if (modalLikeBtn) {
                        const modalLikeIcon = document.getElementById(`modal-like-icon-${photoId}`);
                        const modalLikeCount = document.getElementById(`modal-like-count-${photoId}`);
                        
                        modalLikeCount.textContent = data.likes_count;
                        
                        if (data.liked) {
                            modalLikeBtn.classList.remove('bg-black/40', 'hover:bg-black/60');
                            modalLikeBtn.classList.add('bg-red-500');
                            modalLikeIcon.setAttribute('fill', 'currentColor');
                        } else {
                            modalLikeBtn.classList.remove('bg-red-500');
                            modalLikeBtn.classList.add('bg-black/40', 'hover:bg-black/60');
                            modalLikeIcon.setAttribute('fill', 'none');
                        }
                    }
                }
            } catch (error) {
                console.error('Error toggling like:', error);
            } finally {
                likeBtn.disabled = false;
            }
        }

        // Fungsi untuk membuka modal foto
        function openPhotoModal(photoId, imagePath, title, description, likesCount, isLiked) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 photo-modal-wrapper';

            // Cari semua kartu foto di halaman album (jika ada) untuk navigasi & metadata
            const cards = Array.from(document.querySelectorAll('.album-photo-card'));
            const currentIndex = cards.findIndex(card => parseInt(card.dataset.photoId || '0', 10) === photoId);
            const hasPrev = currentIndex > 0;
            const hasNext = currentIndex !== -1 && currentIndex < cards.length - 1;

            // Ambil metadata (tanggal & views) dari kartu jika tersedia
            let createdAtText = '';
            let viewsCount = 0;
            if (currentIndex !== -1) {
                const card = cards[currentIndex];
                const createdAtRaw = card.dataset.createdAt;
                viewsCount = parseInt(card.dataset.views || '0', 10);
                if (createdAtRaw) {
                    const date = new Date(createdAtRaw);
                    createdAtText = date.toLocaleDateString('id-ID', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    });
                }
            }

            modal.innerHTML = `
                <div class="relative max-w-5xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
                    <!-- Kolom Foto -->
                    <div class="relative md:w-1/2 bg-black flex items-center justify-center">
                        ${hasPrev ? `
                            <button
                                class="hidden md:flex absolute left-2 top-1/2 -translate-y-1/2 z-20 rounded-full bg-black/50 hover:bg-black/70 text-white p-2"
                                onclick="navigatePhotoModal(${photoId}, 'prev')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                        ` : ''}

                        <img src="/storage/${imagePath}" 
                             alt="${title}"
                             class="w-full h-full object-contain bg-black">

                        ${hasNext ? `
                            <button
                                class="hidden md:flex absolute right-2 top-1/2 -translate-y-1/2 z-20 rounded-full bg-black/50 hover:bg-black/70 text-white p-2"
                                onclick="navigatePhotoModal(${photoId}, 'next')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        ` : ''}
                    </div>

                    <!-- Kolom Detail -->
                    <div class="md:w-1/2 flex flex-col">
                        <!-- Header dengan tombol kembali -->
                        <div class="flex items-center justify-between px-4 sm:px-5 pt-4 pb-3 border-b border-gray-200">
                            <button
                                onclick="const m=this.closest('.photo-modal-wrapper'); if(m){m.remove(); document.body.style.overflow='auto';}"
                                class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>

                            <button
                                onclick="const m=this.closest('.photo-modal-wrapper'); if(m){m.remove(); document.body.style.overflow='auto';}"
                                class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Konten -->
                        <div class="flex-1 px-4 sm:px-5 py-4 flex flex-col gap-4 overflow-y-auto">
                            <div>
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-1">${title}</h3>
                                ${description ? `<p class=\"text-sm text-gray-700 leading-relaxed mb-2\">${description}</p>` : ''}

                                <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500">
                                    ${createdAtText ? `<span class=\"inline-flex items-center gap-1\"><svg class=\"w-4 h-4\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z\"/></svg>${createdAtText}</span>` : ''}
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        ${viewsCount} views
                                    </span>
                                </div>
                            </div>

                            <!-- Komentar asli -->
                            <div class="mt-3 border-t border-gray-100 pt-3 flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-semibold text-gray-900">Komentar</h4>
                                    <span id="comment-count-${photoId}" class="text-xs text-gray-500"></span>
                                </div>

                                <div id="comment-list-${photoId}" class="space-y-2 max-h-52 overflow-y-auto text-sm text-gray-800">
                                    <p class="text-xs text-gray-400">Memuat komentar...</p>
                                </div>

                                <form id="comment-form-${photoId}" class="mt-2 flex items-start gap-2">
                                    <textarea
                                        id="comment-input-${photoId}"
                                        class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                        rows="2"
                                        placeholder="Tulis komentar..."
                                    ></textarea>
                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center px-3 py-2 rounded-xl bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition-colors whitespace-nowrap">
                                        Kirim
                                    </button>
                                </form>
                            </div>

                            <div class="mt-auto flex items-center justify-between gap-2 pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <!-- Like button -->
                                    <button
                                        onclick="event.stopPropagation(); toggleLike(${photoId})"
                                        id="modal-like-btn-${photoId}"
                                        class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-gray-900 text-white text-sm font-medium hover:bg-black transition-colors">
                                        <svg
                                            id="modal-like-icon-${photoId}"
                                            class="w-5 h-5"
                                            fill="${isLiked ? 'currentColor' : 'none'}"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        <span id="modal-like-count-${photoId}" class="text-sm font-semibold">${likesCount}</span>
                                    </button>

                                    <!-- Comment icon -->
                                    <button
                                        type="button"
                                        onclick="event.stopPropagation(); handleCommentIconClick(${photoId});"
                                        class="inline-flex items-center justify-center p-2 rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v7a2 2 0 01-2 2h-5l-4 4z" />
                                        </svg>
                                    </button>

                                    <!-- Share icon -->
                                    <button
                                        type="button"
                                        onclick="event.stopPropagation(); handleShareIconClick(${photoId});"
                                        class="inline-flex items-center justify-center p-2 rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 17c0-4 4-7 9-7h1V7l6 5-6 5v-3h-1c-3.5 0-6 1.5-7.5 3.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.remove();
                    document.body.style.overflow = 'auto';
                }
            });

            // Inisialisasi komentar setelah modal dibuat
            initPhotoComments(photoId);
        }

        // Navigasi antar foto di modal (prev/next)
        function navigatePhotoModal(currentPhotoId, direction) {
            const cards = Array.from(document.querySelectorAll('.album-photo-card'));
            const currentIndex = cards.findIndex(card => parseInt(card.dataset.photoId || '0', 10) === currentPhotoId);
            if (currentIndex === -1) return;

            let targetIndex = currentIndex;
            if (direction === 'next' && currentIndex < cards.length - 1) {
                targetIndex = currentIndex + 1;
            } else if (direction === 'prev' && currentIndex > 0) {
                targetIndex = currentIndex - 1;
            } else {
                return;
            }

            const targetCard = cards[targetIndex];
            const photoId = parseInt(targetCard.dataset.photoId || '0', 10);
            const imageEl = targetCard.querySelector('img');
            const imagePathMatch = imageEl?.getAttribute('src')?.match(/storage\/(.*)$/);
            const imagePath = imagePathMatch ? imagePathMatch[1] : '';
            const title = imageEl?.getAttribute('alt') || '';
            const descEl = targetCard.querySelector('.photo-description');
            const description = descEl ? descEl.textContent.trim() : '';
            const likes = parseInt(targetCard.dataset.likes || '0', 10);
            const views = parseInt(targetCard.dataset.views || '0', 10);

            // Perkiraan status like dari class tombol
            const likeBtn = document.getElementById(`like-btn-${photoId}`);
            const isLiked = likeBtn ? likeBtn.classList.contains('bg-red-500/90') : false;

            // Tutup modal lama, buka yang baru
            const currentModal = document.querySelector('.photo-modal-wrapper');
            if (currentModal) currentModal.remove();
            document.body.style.overflow = 'auto';

            openPhotoModal(photoId, imagePath, title, description, likes, isLiked);
        }

        async function initPhotoComments(photoId) {
            const listEl = document.getElementById(`comment-list-${photoId}`);
            const countEl = document.getElementById(`comment-count-${photoId}`);
            const formEl = document.getElementById(`comment-form-${photoId}`);
            const inputEl = document.getElementById(`comment-input-${photoId}`);

            if (!listEl || !formEl || !inputEl) return;

            // Load existing comments
            try {
                const res = await fetch(`/photo/${photoId}/comments`);
                if (!res.ok) throw new Error('Gagal memuat komentar');
                const json = await res.json();
                const comments = json.data || [];

                if (comments.length === 0) {
                    listEl.innerHTML = '<p class="text-xs text-gray-400">Belum ada komentar. Jadilah yang pertama berkomentar.</p>';
                } else {
                    listEl.innerHTML = comments.map(c => `
                        <div class=\"flex items-start gap-2\">
                            <div class=\"w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-[11px] font-semibold text-gray-600\">${(c.user_name || '?').slice(0,2).toUpperCase()}</div>
                            <div class=\"flex-1\">
                                <div class=\"text-xs text-gray-500 mb-0.5\">${c.user_name || 'User'} · ${c.created_at}</div>
                                <p class=\"text-sm text-gray-800 leading-snug\">${c.content}</p>
                            </div>
                        </div>
                    `).join('');
                }

                if (countEl) {
                    countEl.textContent = comments.length > 0 ? `${comments.length} komentar` : '';
                }
            } catch (e) {
                listEl.innerHTML = '<p class="text-xs text-red-500">Gagal memuat komentar.</p>';
            }

            // Handle submit
            formEl.addEventListener('submit', async function (e) {
                e.preventDefault();

                const content = inputEl.value.trim();
                if (!content) return;

                // Jika belum login, arahkan ke register seperti like
                if (typeof window.isAuthenticated !== 'undefined' && !window.isAuthenticated) {
                    const registerBase = window.registerUrl || '/register';
                    const redirectUrl = encodeURIComponent(window.location.href);
                    window.location.href = `${registerBase}?redirect=${redirectUrl}`;
                    return;
                }

                try {
                    const res = await fetch(`/photo/${photoId}/comments`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ content }),
                    });

                    if (res.status === 401) {
                        const registerBase = window.registerUrl || '/register';
                        const redirectUrl = encodeURIComponent(window.location.href);
                        window.location.href = `${registerBase}?redirect=${redirectUrl}`;
                        return;
                    }

                    if (!res.ok) throw new Error('Gagal mengirim komentar');

                    const json = await res.json();
                    const c = json.data;

                    // Tambah komentar baru di atas
                    const existing = listEl.querySelector('p.text-xs.text-gray-400');
                    if (existing) existing.remove();

                    const itemHtml = `
                        <div class=\"flex items-start gap-2\">
                            <div class=\"w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-[11px] font-semibold text-gray-600\">${(c.user_name || '?').slice(0,2).toUpperCase()}</div>
                            <div class=\"flex-1\">
                                <div class=\"text-xs text-gray-500 mb-0.5\">${c.user_name || 'User'} · ${c.created_at}</div>
                                <p class=\"text-sm text-gray-800 leading-snug\">${c.content}</p>
                            </div>
                        </div>
                    `;

                    listEl.insertAdjacentHTML('afterbegin', itemHtml);

                    if (countEl) {
                        const current = parseInt((countEl.textContent || '0').match(/\d+/)?.[0] || '0', 10) + 1;
                        countEl.textContent = `${current} komentar`;
                    }

                    inputEl.value = '';
                } catch (err) {
                    alert('Gagal mengirim komentar. Silakan coba lagi.');
                }
            });
        }

        function handleCommentIconClick(photoId) {
            const inputEl = document.getElementById(`comment-input-${photoId}`);

            // Jika belum login, arahkan ke register
            if (typeof window.isAuthenticated !== 'undefined' && !window.isAuthenticated) {
                const registerBase = window.registerUrl || '/register';
                const redirectUrl = encodeURIComponent(window.location.href);
                window.location.href = `${registerBase}?redirect=${redirectUrl}`;
                return;
            }

            if (inputEl) {
                inputEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => inputEl.focus(), 200);
            }
        }

        function openCommentFromGrid(photoId, imagePath, title, description, likesCount, isLiked) {
            // Buka modal foto seperti biasa
            openPhotoModal(photoId, imagePath, title, description, likesCount, isLiked);

            // Setelah sedikit delay, fokuskan ke textarea komentar
            setTimeout(() => {
                const inputEl = document.getElementById(`comment-input-${photoId}`);
                if (inputEl) {
                    inputEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    inputEl.focus();
                }
            }, 250);
        }

        function handleShareIconClick(photoId) {
            // Jika belum login, arahkan ke register
            if (typeof window.isAuthenticated !== 'undefined' && !window.isAuthenticated) {
                const registerBase = window.registerUrl || '/register';
                const redirectUrl = encodeURIComponent(window.location.href);
                window.location.href = `${registerBase}?redirect=${redirectUrl}`;
                return;
            }

            // Untuk saat ini, share = copy URL halaman ke clipboard
            const shareUrl = window.location.href;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(shareUrl)
                    .then(() => {
                        alert('Link foto berhasil disalin ke clipboard.');
                    })
                    .catch(() => {
                        alert('Gagal menyalin link. Anda bisa menyalin URL secara manual.');
                    });
            } else {
                // Fallback jika Clipboard API tidak tersedia
                const tempInput = document.createElement('input');
                tempInput.value = shareUrl;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand('copy');
                    alert('Link foto berhasil disalin ke clipboard.');
                } catch (e) {
                    alert('Gagal menyalin link. Anda bisa menyalin URL secara manual.');
                }
                document.body.removeChild(tempInput);
            }
        }

        function closeAlbumView() {
            const modal = document.getElementById('albumViewModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closePhotoView() {
            const modal = document.getElementById('photoViewModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modals on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAlbumView();
                const photoModal = document.querySelector('.fixed.inset-0.z-50.flex');
                if (photoModal) {
                    photoModal.remove();
                    document.body.style.overflow = 'auto';
                }
            }
        });
    </script>
