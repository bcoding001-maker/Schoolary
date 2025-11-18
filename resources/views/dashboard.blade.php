<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Admin Message -->
            <div class="mb-4 sm:mb-6">
                <p class="text-lg sm:text-2xl font-semibold text-gray-800 dark:text-gray-100">
                    Selamat datang, <span class="text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name }}</span> 👋
                </p>
                <p class="mt-1 text-sm sm:text-base text-gray-600 dark:text-gray-300">
                    Kelola berita, agenda, galeri, dan data lainnya langsung dari dashboard ini.
                </p>
            </div>

            <!-- Statistik Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 lg:gap-6 mb-6 sm:mb-8">
                <!-- Total Berita -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover:shadow-2xl active:scale-95 sm:hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Total Berita</p>
                            <p class="text-white text-3xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $totalBerita }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300 flex-shrink-0 ml-2">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Agenda -->
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover:shadow-2xl active:scale-95 sm:hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Total Agenda</p>
                            <p class="text-white text-3xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $totalAgenda }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300 flex-shrink-0 ml-2">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Albums -->
                <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover:shadow-2xl active:scale-95 sm:hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Total Gallery</p>
                            <p class="text-white text-3xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $totalAlbums }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300 flex-shrink-0 ml-2">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover:shadow-2xl active:scale-95 sm:hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Total Kategori</p>
                            <p class="text-white text-3xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $totalKategori }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300 flex-shrink-0 ml-2">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h.01M3 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Visitors -->
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-xl hover:shadow-2xl active:scale-95 sm:hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-xs sm:text-sm font-medium uppercase tracking-wider truncate">Total Visitors</p>
                            <p class="text-white text-3xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $totalVisitors }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300 flex-shrink-0 ml-2">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5c-2.5 0-4.847-.735-6.16-2.078L12 14z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Preview Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0 mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Welcome Page Preview</h3>
                        <button onclick="togglePreview()" 
                                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg text-white text-sm font-semibold tracking-wide hover:from-blue-600 hover:to-indigo-700 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0l3-3m-3 3l3 3"/>
                            </svg>
                            Preview Welcome Page
                        </button>
                    </div>

                    <!-- Modal -->
                    <div id="welcomePreview" class="fixed inset-0 bg-black/90 hidden z-50">
                        <div class="absolute inset-0 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/70 backdrop-blur-sm"></div>
                            
                            <!-- Modal Content -->
                            <div class="relative min-h-screen flex items-center justify-center p-4">
                                <div class="bg-white dark:bg-gray-900 w-full max-w-[95%] lg:max-w-[1600px] h-[90vh] rounded-2xl shadow-2xl overflow-hidden">
                                    <!-- Modal Header -->
                                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800 sticky top-0 z-10">
                                        <h4 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-200">Welcome Page Preview</h4>
                                        <button onclick="togglePreview()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors p-2">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Preview Content -->
                                    <div class="relative h-[calc(90vh-57px)] overflow-hidden">
                                        <div class="absolute inset-0 overflow-auto custom-scrollbar">
                                            <div class="p-4 sm:p-8">
                                                <div class="max-w-[1400px] mx-auto transform scale-90 sm:scale-95 origin-top">
                                                    @include('welcome')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Custom Scrollbar yang lebih elegan */
    .custom-scrollbar::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(156, 163, 175, 0.5);
        border-radius: 5px;
        border: 2px solid transparent;
        background-clip: padding-box;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(156, 163, 175, 0.8);
        border: 2px solid transparent;
        background-clip: padding-box;
    }

    /* Dark mode scrollbar */
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(75, 85, 99, 0.5);
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(75, 85, 99, 0.8);
    }

    /* Tambahkan smooth scrolling */
    .custom-scrollbar {
        scroll-behavior: smooth;
    }

    /* Animasi untuk modal */
    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .modal-animation {
        animation: modalFadeIn 0.3s ease-out;
    }
    </style>

    <script>
        function togglePreview() {
            const preview = document.getElementById('welcomePreview');
            const body = document.body;
            
            if (preview.classList.contains('hidden')) {
                // Show preview
                preview.classList.remove('hidden');
                body.style.overflow = 'hidden';
                
                // Add animation
                requestAnimationFrame(() => {
                    preview.querySelector('.bg-white').classList.add('modal-animation');
                });
            } else {
                // Hide preview with fade-out
                preview.querySelector('.bg-white').style.opacity = '0';
                preview.style.opacity = '0';
                preview.style.transition = 'opacity 0.2s ease-out';
                
                setTimeout(() => {
                    preview.classList.add('hidden');
                    body.style.overflow = 'auto';
                    preview.style.opacity = '';
                    preview.style.transition = '';
                }, 200);
            }
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const preview = document.getElementById('welcomePreview');
                if (!preview.classList.contains('hidden')) {
                    togglePreview();
                }
            }
        });
    </script>
</x-app-layout>
