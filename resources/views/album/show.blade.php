<x-guest-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 py-10">
            <div class="mb-6">
                <a href="{{ route('welcome') }}#galeri" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Galeri
                </a>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-blue-500 mb-1">Album Galeri</p>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $album->album_name }}</h1>

                        <div class="flex flex-wrap items-center gap-2 text-xs text-gray-600">
                            @if($album->kategori)
                                <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-3 py-1 rounded-full border border-blue-100">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                    </svg>
                                    {{ $album->kategori->kategori_judul }}
                                </span>
                            @endif
                            <span class="inline-flex items-center gap-1 bg-gray-100 px-3 py-1 rounded-full">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2z" />
                                </svg>
                                {{ $album->photos->count() }} foto
                            </span>
                        </div>
                    </div>

                    @if($album->cover_image)
                        <div class="w-full md:w-52 h-40 md:h-32 rounded-xl overflow-hidden border border-gray-200 shadow-md">
                            <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->album_name }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>

                @if($breadcrumbs->isNotEmpty())
                    <div class="mt-3 text-xs text-gray-500 flex flex-wrap items-center gap-1">
                        <span class="text-gray-400">Lokasi:</span>
                        <a href="{{ route('welcome') }}#galeri" class="text-blue-600 hover:text-blue-500">Galeri</a>
                        @foreach($breadcrumbs as $crumb)
                            <span class="text-gray-400">/</span>
                            <a href="{{ route('album.show', $crumb) }}" class="text-blue-600 hover:text-blue-500">{{ $crumb->album_name }}</a>
                        @endforeach
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-semibold">{{ $album->album_name }}</span>
                    </div>
                @endif

                @if($album->description)
                    <div class="mt-6 bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm text-gray-700 leading-relaxed">
                        {{ $album->description }}
                    </div>
                @endif
            </div>

            @if($album->children->count())
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Sub Album ({{ $album->children->count() }})
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($album->children as $child)
                            @include('components.album-card', ['album' => $child])
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <div class="flex flex-wrap items-center justify-between mb-4 gap-3">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2z" />
                        </svg>
                        Foto di album ini (<span id="albumPhotoCount">{{ $album->photos->count() }}</span>)
                    </h2>

                    @if($album->photos->count())
                        <div class="flex flex-wrap items-center gap-3 text-xs">
                            <div class="flex items-center gap-2">
                                <label for="albumSortBy" class="text-gray-500 font-medium">Urutkan:</label>
                                <select id="albumSortBy" class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="newest">📅 Terbaru</option>
                                    <option value="oldest">📅 Terlama</option>
                                    <option value="most_liked">❤️ Paling Disukai</option>
                                    <option value="most_viewed">👁️ Paling Dilihat</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="albumFilterBy" class="text-gray-500 font-medium">Rentang:</label>
                                <select id="albumFilterBy" class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="all">🕐 Semua Waktu</option>
                                    <option value="today">📆 Hari Ini</option>
                                    <option value="week">📅 Minggu Ini</option>
                                    <option value="month">📅 Bulan Ini</option>
                                    <option value="year">📅 Tahun Ini</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                @if($album->photos->count())
                    <div id="albumPhotoGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                        @foreach($album->photos as $photo)
                            <div
                                class="album-photo-card group bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300"
                                data-photo-id="{{ $photo->id }}"
                                data-created-at="{{ $photo->created_at }}"
                                data-likes="{{ $photo->likes_count ?? 0 }}"
                                data-views="{{ $photo->views_count ?? 0 }}">
                                <div class="relative aspect-square overflow-hidden bg-gray-100">
                                    <img
                                        src="{{ asset('storage/' . $photo->image_path) }}"
                                        alt="{{ $photo->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 cursor-pointer"
                                        onclick="openPhotoModal({{ $photo->id }}, '{{ $photo->image_path }}', '{{ $photo->title }}', '{{ $photo->description }}', {{ $photo->likes_count ?? 0 }}, {{ $photo->is_liked ?? 'false' }}); incrementPhotoView({{ $photo->id }});">

                                    <!-- Like Button -->
                                    <button
                                        onclick="event.stopPropagation(); toggleLike({{ $photo->id }});"
                                        id="like-btn-{{ $photo->id }}"
                                        class="absolute top-3 right-3 z-10 flex items-center space-x-1 px-3 py-1.5 rounded-full backdrop-blur-md transition-all duration-300 {{ ($photo->is_liked ?? false) ? 'bg-red-500/90 text-white' : 'bg-black/40 text-white hover:bg-black/60' }}">
                                        <svg
                                            id="like-icon-{{ $photo->id }}"
                                            class="w-5 h-5 transition-transform {{ ($photo->is_liked ?? false) ? 'fill-current' : '' }}"
                                            fill="{{ ($photo->is_liked ?? false) ? 'currentColor' : 'none' }}"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        <span id="like-count-{{ $photo->id }}" class="text-sm font-semibold">{{ $photo->likes_count ?? 0 }}</span>
                                    </button>

                                    <!-- Views Counter -->
                                    <div class="absolute top-3 left-3 z-10 flex items-center space-x-1 px-2 py-1 rounded-full bg-black/40 backdrop-blur-md text-white text-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>{{ $photo->views_count ?? 0 }}</span>
                                    </div>

                                    <!-- Hover Overlay Title -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end cursor-pointer"
                                        onclick="openPhotoModal({{ $photo->id }}, '{{ $photo->image_path }}', '{{ $photo->title }}', '{{ $photo->description }}', {{ $photo->likes_count ?? 0 }}, {{ $photo->is_liked ?? 'false' }}); incrementPhotoView({{ $photo->id }});">
                                        <div class="p-3 w-full flex items-center justify-between text-xs text-white">
                                            <div class="truncate pr-2">
                                                @if($photo->title)
                                                    <p class="font-medium truncate">{{ $photo->title }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($photo->description)
                                    <div class="px-3 py-2 text-xs text-gray-600 border-t border-gray-100 bg-gray-50 line-clamp-2 photo-description">
                                        {{ $photo->description }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-16 text-center text-gray-500 border border-dashed border-gray-300 rounded-2xl bg-white">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold mb-1 text-gray-800">Belum ada foto di album ini</h3>
                        <p class="text-sm text-gray-500">Silakan kembali lagi nanti, foto akan segera ditambahkan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($album->photos->count())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const grid = document.getElementById('albumPhotoGrid');
                if (!grid) return;

                const sortSelect = document.getElementById('albumSortBy');
                const filterSelect = document.getElementById('albumFilterBy');
                const countSpan = document.getElementById('albumPhotoCount');

                // Snapshot awal untuk dasar filter (semua foto tanpa urutan khusus)
                const originalCards = Array.from(grid.querySelectorAll('.album-photo-card'));

                function applyAlbumSortFilter() {
                    let cards = [...originalCards];
                    const sortBy = sortSelect?.value || 'newest';
                    const filterBy = filterSelect?.value || 'all';

                    const now = new Date();

                    // Filter tanggal
                    if (filterBy !== 'all') {
                        cards = cards.filter(card => {
                            const createdAt = new Date(card.dataset.createdAt);
                            switch (filterBy) {
                                case 'today':
                                    return createdAt.toDateString() === now.toDateString();
                                case 'week': {
                                    const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                                    return createdAt >= weekAgo;
                                }
                                case 'month':
                                    return createdAt.getMonth() === now.getMonth() && createdAt.getFullYear() === now.getFullYear();
                                case 'year':
                                    return createdAt.getFullYear() === now.getFullYear();
                                default:
                                    return true;
                            }
                        });
                    }

                    // Sorting
                    cards.sort((a, b) => {
                        const aDate = new Date(a.dataset.createdAt);
                        const bDate = new Date(b.dataset.createdAt);

                        // Baca like terkini dari DOM (agar perubahan like langsung berpengaruh)
                        const aPhotoId = parseInt(a.dataset.photoId || '0', 10);
                        const bPhotoId = parseInt(b.dataset.photoId || '0', 10);
                        const aLikeEl = document.getElementById(`like-count-${aPhotoId}`);
                        const bLikeEl = document.getElementById(`like-count-${bPhotoId}`);
                        const aLikes = aLikeEl ? parseInt(aLikeEl.textContent || '0', 10) : parseInt(a.dataset.likes || '0', 10);
                        const bLikes = bLikeEl ? parseInt(bLikeEl.textContent || '0', 10) : parseInt(b.dataset.likes || '0', 10);

                        // Views masih mengacu pada data awal (DOM tidak diupdate saat view bertambah)
                        const aViews = parseInt(a.dataset.views || '0', 10);
                        const bViews = parseInt(b.dataset.views || '0', 10);

                        switch (sortBy) {
                            case 'newest':
                                return bDate - aDate;
                            case 'oldest':
                                return aDate - bDate;
                            case 'most_liked':
                                return bLikes - aLikes;
                            case 'most_viewed':
                                return bViews - aViews;
                            default:
                                return 0;
                        }
                    });

                    // Render ulang
                    grid.innerHTML = '';
                    cards.forEach(card => grid.appendChild(card));

                    if (countSpan) {
                        countSpan.textContent = cards.length;
                    }
                }

                sortSelect?.addEventListener('change', applyAlbumSortFilter);
                filterSelect?.addEventListener('change', applyAlbumSortFilter);

                // Terapkan filter/urutan awal (default Terbaru & Semua Waktu)
                applyAlbumSortFilter();
            });
        </script>
    @endif

    {{-- Modals & Scripts guest agar fitur like/filter berfungsi --}}
    @include('components.guest.modals')
    @include('components.guest.scripts')
</x-guest-layout>
