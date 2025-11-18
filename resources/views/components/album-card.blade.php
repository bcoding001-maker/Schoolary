<!-- Instagram-Style Album Card -->
<div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer overflow-hidden transform hover:-translate-y-2"
     onclick="viewAlbum('{{ $album->album_id }}')">
    
    <!-- Album Cover with Instagram Square Aspect Ratio -->
    <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
        @if($album->cover_image)
            <img src="{{ asset('storage/' . $album->cover_image) }}" 
                 alt="{{ $album->album_name }}"
                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out"
                 loading="lazy">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 flex items-center justify-center">
                <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif
        
        <!-- Instagram-Style Gradient Overlay on Hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500">
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <!-- View Icon -->
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 mb-3 transform scale-0 group-hover:scale-100 transition-transform duration-500 delay-100">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-150">LIHAT ALBUM</span>
            </div>
        </div>

        <!-- Photo Count Badge (Instagram Style) -->
        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-white px-3 py-1.5 rounded-full text-xs font-semibold flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            {{ $album->photos_count ?? $album->photos->count() }}
        </div>
    </div>
    
    <!-- Album Info (Instagram Post Style) -->
    <div class="p-4 bg-white">
        <!-- Album Title -->
        <h3 class="text-base font-bold text-gray-900 mb-1 line-clamp-1 group-hover:text-blue-600 transition-colors duration-300">
            {{ $album->album_name }}
        </h3>
        
        <!-- Description -->
        @if($album->description)
            <p class="text-gray-600 text-sm line-clamp-2 mb-3 leading-relaxed">
                {{ $album->description }}
            </p>
        @endif
        
        <!-- Bottom Info Bar -->
        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <!-- Category Badge -->
            @if($album->kategori)
                <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-blue-500 to-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                    </svg>
                    {{ $album->kategori->kategori_judul }}
                </span>
            @endif
            
            <!-- View Button -->
            <button class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center gap-1 transition-colors duration-200">
                <span>Lihat</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>