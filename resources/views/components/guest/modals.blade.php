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
                                    <option value="newest">📅 Terbaru</option>
                                    <option value="oldest">📅 Terlama</option>
                                    <option value="most_liked">❤️ Paling Disukai</option>
                                    <option value="most_viewed">👁️ Paling Dilihat</option>
                                </select>
                            </div>

                            <!-- Filter By Date -->
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                <select id="filterBy" onchange="applySortAndFilter()" 
                                        class="px-3 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                    <option value="all">🕐 Semua Waktu</option>
                                    <option value="today">📆 Hari Ini</option>
                                    <option value="week">📅 Minggu Ini</option>
                                    <option value="month">📅 Bulan Ini</option>
                                    <option value="year">📅 Tahun Ini</option>
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
