<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Include Styles Component --}}
    @include('components.welcome.styles')
</head>
<body class="antialiased min-h-screen bg-white">
    {{-- Navigation Component --}}
    @include('components.welcome.navigation')

    {{-- Hero Section Component --}}
    @include('components.welcome.hero')

    {{-- Galeri Section Component --}}
    @include('components.welcome.galeri')

    {{-- Berita & Agenda Section Component --}}
    @include('components.welcome.berita-agenda')

    {{-- Mitra Section Component --}}
    @include('components.welcome.mitra')

    {{-- Kontak Section Component --}}
    {{-- @include('components.welcome.kontak') --}}

    {{-- Footer Component --}}
    @include('components.welcome.footer')

    {{-- Scroll to top button --}}
    <button id="scrollToTop" class="fixed bottom-8 right-8 elegant-button p-3 rounded-full opacity-0 transition-opacity duration-300">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    {{-- Berita Preview Modal --}}
    <div id="beritaPreviewModal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
            <div class="fixed inset-0 bg-black/80 transition-opacity"></div>
            <div class="inline-block w-full max-w-4xl mt-24 mb-8 text-left align-middle transition-all transform bg-slate-900 shadow-xl rounded-2xl relative z-[70]">
                <button onclick="closeBeritaPreview()" class="absolute top-4 right-4 z-[80] text-gray-400 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div class="p-8">
                    <h2 id="beritaPreviewTitle" class="text-3xl font-bold text-white mb-6"></h2>
                    <div id="beritaPreviewContent" class="text-gray-300 prose prose-invert max-w-none"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- AI Assistant Widget --}}
    <div class="ai-assistant-wrapper">
        <div id="ai-assistant-panel" class="ai-assistant-panel hidden">
            <div class="ai-assistant-header">
                <div class="info">
                    <img src="assets/img/cobo.png" alt="Assistant Bot">
                    <div>
                        <p class="font-semibold text-sm">Cobo</p>
                        <p class="text-xs opacity-90">Asisten interaktif & lucu</p>
                    </div>
                </div>
                <button id="ai-assistant-close" class="text-white/80 hover:text-white text-xl">&times;</button>
            </div>
            <div class="ai-assistant-body">
                <div id="ai-assistant-messages" class="ai-assistant-messages">
                    <div class="assistant-bubble">
                        Halo! Aku Cobo 🤖✨ Siap bantu kamu keliling website kece ini. Mau nanya apa nih?
                    </div>
                </div>
                <div class="ai-quick-questions">
                    <button class="ai-quick-question" data-question="Apa itu Schoolary?">Apa itu Schoolary?</button>
                    <button class="ai-quick-question" data-question="Untuk apa Schoolary dibuat?">Untuk apa Schoolary dibuat?</button>
                    <button class="ai-quick-question" data-question="Bagaimana cara mendaftar di Schoolary?">Bagaimana cara mendaftar?</button>
                    <button class="ai-quick-question" data-question="Apa fungsi utama dari Schoolary?">Fungsi utama Schoolary?</button>
                    <button class="ai-quick-question" data-question="Apa saja fitur yang ada di Schoolary?">Fitur Schoolary?</button>
                </div>
            </div>
            <div class="ai-assistant-input-wrapper">
                <div class="flex">
                    <input id="ai-assistant-input" type="text" placeholder="Tanya apapun tentang website ini...">
                    <button id="ai-assistant-send">Kirim</button>
                </div>
            </div>
        </div>

        <div id="ai-assistant-toggle" class="ai-assistant-toggle">
            <img src="assets/img/cobo.png" alt="Assistant Bot">
            <span class="ai-assistant-badge">Hi!</span>
        </div>
    </div>

    {{-- Scripts --}}
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
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
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
            const navElement = document.getElementById('nav-' + sectionId);
            if (navElement) {
                navElement.classList.add('active');
            }
        }

        document.querySelectorAll('.nav-link[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = 80;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    setActiveNav(this.getAttribute('href').replace('#',''));
                }
            });
        });

        // Aktifkan menu sesuai section saat scroll
        window.addEventListener('scroll', () => {
            const sections = ['beranda','galeri','berita-agenda','kontak'];
            let current = 'beranda';
            for (const id of sections) {
                const el = document.getElementById(id);
                if (el && window.scrollY + 100 >= el.offsetTop) {
                    current = id;
                }
            }
            setActiveNav(current);
        });

        // Gallery Category Switching
        function showGalleryCategory(categoryId) {
            const allContents = document.querySelectorAll('.gallery-category-content');
            allContents.forEach(content => {
                content.classList.add('hidden');
            });

            const selectedContent = document.getElementById(categoryId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
                selectedContent.style.animation = 'none';
                setTimeout(() => {
                    selectedContent.style.animation = '';
                }, 10);
            }

            const allTabs = document.querySelectorAll('.gallery-category-tab');
            allTabs.forEach(tab => {
                tab.classList.remove('active');
            });

            const activeTab = document.querySelector(`[onclick="showGalleryCategory('${categoryId}')"]`);
            if (activeTab) {
                activeTab.classList.add('active');
                activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }

            const searchInput = document.getElementById('albumSearch');
            if (searchInput && searchInput.value) {
                searchInput.value = '';
                const searchResults = document.getElementById('search-results');
                const galleryContent = document.querySelector('.gallery-content');
                if (searchResults) searchResults.classList.add('hidden');
                if (galleryContent) galleryContent.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showGalleryCategory('all-albums');
        });

        // Album Search
        function searchAlbums() {
            const searchInput = document.getElementById('albumSearch');
            const searchQuery = searchInput.value.toLowerCase().trim();
            const searchResults = document.getElementById('search-results');
            const galleryContent = document.querySelector('.gallery-content');

            if (searchQuery === '') {
                searchResults.classList.add('hidden');
                galleryContent.classList.remove('hidden');
                return;
            }

            galleryContent.classList.add('hidden');
            searchResults.classList.remove('hidden');

            const searchResultsGrid = searchResults.querySelector('.grid');
            searchResultsGrid.innerHTML = '';

            const allAlbumCards = document.querySelectorAll('#all-albums > .grid > div');

            let found = false;
            const addedAlbums = new Set();

            allAlbumCards.forEach(card => {
                const onclickAttr = card.getAttribute('onclick');
                const albumId = onclickAttr ? onclickAttr.match(/viewAlbum\('(\d+)'\)/)?.[1] : null;

                if (albumId && addedAlbums.has(albumId)) {
                    return;
                }

                const albumNameElement = card.querySelector('h3');
                const albumName = albumNameElement ? albumNameElement.textContent.toLowerCase() : '';

                const categoryElement = card.querySelector('.rounded-full');
                const albumCategory = categoryElement ? categoryElement.textContent.toLowerCase() : '';

                const descriptionElement = card.querySelector('p.text-gray-300');
                const albumDescription = descriptionElement ? descriptionElement.textContent.toLowerCase() : '';

                if (albumName.includes(searchQuery) ||
                    albumCategory.includes(searchQuery) ||
                    albumDescription.includes(searchQuery)) {

                    const clonedCard = card.cloneNode(true);
                    searchResultsGrid.appendChild(clonedCard);

                    if (albumId) {
                        addedAlbums.add(albumId);
                    }

                    found = true;
                }
            });

            if (!found) {
                searchResultsGrid.innerHTML = `
                    <div class="col-span-full text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada hasil</h3>
                        <p class="text-gray-600">Tidak ditemukan album yang sesuai dengan pencarian "<span class="font-semibold">${searchQuery}</span>"</p>
                    </div>
                `;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('albumSearch');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(searchAlbums, 300));
            }
        });

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

        // Berita Preview
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

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBeritaPreview();
            }
        });

        // View Album
        async function viewAlbum(albumId) {
            window.location.href = `/album/${albumId}`;
        }

        // AI Assistant
        document.addEventListener('DOMContentLoaded', () => {
            const aiToggle = document.getElementById('ai-assistant-toggle');
            const aiPanel = document.getElementById('ai-assistant-panel');
            const aiClose = document.getElementById('ai-assistant-close');
            const aiInput = document.getElementById('ai-assistant-input');
            const aiSend = document.getElementById('ai-assistant-send');
            const aiMessages = document.getElementById('ai-assistant-messages');
            const quickQuestions = document.querySelectorAll('.ai-quick-question');

            const showPanel = () => {
                if (!aiPanel) return;
                aiPanel.classList.remove('hidden');
                aiPanel.style.display = 'flex';
            };

            const hidePanel = () => {
                if (!aiPanel) return;
                aiPanel.classList.add('hidden');
                aiPanel.style.display = 'none';
            };

            hidePanel();

            function appendMessage(content, type = 'assistant') {
                const bubble = document.createElement('div');
                bubble.className = type === 'assistant' ? 'assistant-bubble animate-slide-up' : 'user-bubble animate-slide-up';
                bubble.textContent = content;
                aiMessages.appendChild(bubble);
                aiMessages.scrollTop = aiMessages.scrollHeight;
            }

            const cannedResponses = [
                {
                    keywords: ['apa itu schoolary', 'schoolary itu apa'],
                    answer: 'Schoolary adalah website galeri sekolah yang memudahkan siswa, guru, dan orang tua untuk mengakses dokumentasi sekolah mulai dari kegiatan, prestasi, hingga foto guru dan staf.'
                },
                {
                    keywords: ['untuk apa schoolary', 'tujuan schoolary'],
                    answer: 'Schoolary dibuat agar sekolah bisa menyimpan, mengelola, dan membagikan dokumentasi kegiatan, prestasi, serta informasi penting lainnya secara terstruktur dan mudah diakses.'
                },
                {
                    keywords: ['bagaimana cara mendaftar', 'cara mendaftar', 'daftar', 'register'],
                    answer:
                        'Cara mendaftar:\n' +
                        '1. Tekan tombol "Login" di pojok kanan atas\n' +
                        '2. Pilih "Sign Up" bila belum punya akun\n' +
                        '3. Selesai! Kamu bisa menggunakan fitur Like, Komen, dan Share.'
                },
                {
                    keywords: ['fungsi utama schoolary', 'fungsi utama'],
                    answer: 'Fungsi utama Schoolary adalah Galeri Sekolah digital sebagai tempat semua dokumentasi penting disimpan dan bisa dilihat kapan pun.'
                },
                {
                    keywords: ['fitur schoolary', 'apa saja fitur'],
                    answer: 'Fitur Schoolary meliputi Galeri (Like, Komen, Share), Berita & Agenda, Kontak, registrasi/login pengguna, dan AI Assistant.'
                }
            ];

            const defaultResponse = 'Maaf, Cobo belum menemukan jawabannya. Coba gunakan kata kunci lain atau hubungi sekolah lewat halaman Kontak ya!';

            const getAssistantAnswer = (message) => {
                if (!message) return defaultResponse;
                const lower = message.toLowerCase();
                const matched = cannedResponses.find(item => item.keywords.some(keyword => lower.includes(keyword)));
                return matched ? matched.answer : defaultResponse;
            };

            function simulateAssistantReply(userMessage) {
                appendMessage(userMessage, 'user');
                const typingBubble = document.createElement('div');
                typingBubble.className = 'assistant-bubble';
                typingBubble.innerHTML = `<div class="ai-typing"><span></span><span></span><span></span></div>`;
                aiMessages.appendChild(typingBubble);
                aiMessages.scrollTop = aiMessages.scrollHeight;

                setTimeout(() => {
                    typingBubble.remove();
                    appendMessage(getAssistantAnswer(userMessage));
                }, 700);
            }

            aiToggle?.addEventListener('click', () => {
                if (!aiPanel) return;
                if (aiPanel.classList.contains('hidden')) {
                    showPanel();
                } else {
                    hidePanel();
                }
            });

            aiClose?.addEventListener('click', (e) => {
                e.preventDefault();
                hidePanel();
            });

            aiSend?.addEventListener('click', () => {
                const message = aiInput.value.trim();
                if (!message) return;
                aiInput.value = '';
                simulateAssistantReply(message);
            });

            aiInput?.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    aiSend.click();
                }
            });

            quickQuestions.forEach(btn => {
                btn.addEventListener('click', () => {
                    simulateAssistantReply(btn.dataset.question);
                });
            });
        });
    </script>
</body>
</html>
