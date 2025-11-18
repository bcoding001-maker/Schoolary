<!-- Berita & Agenda Section -->
<section id="berita-agenda" class="section-spacing relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-700 mb-3">Berita & Agenda</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-slate-600 to-blue-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Berita Column -->
            <div class="space-y-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-indigo-700">Berita Terbaru</h3>
                    <a href="#" class="text-indigo-700 hover:text-indigo-500 text-sm font-semibold">Lihat Semua</a>
                </div>

                <!-- News Grid -->
                <div class="grid grid-cols-1 gap-5">
                    @foreach($beritas as $berita)
                        <div class="glass-card rounded-2xl overflow-hidden hover-lift cursor-pointer group"
                             onclick="showBeritaPreview('{{ $berita->berita_id }}')">
                            <!-- Thumbnail -->
                            <div class="relative h-44 overflow-hidden">
                                @if($berita->thumbnail)
                                    <img src="{{ asset('storage/berita/' . $berita->thumbnail) }}" 
                                         alt="{{ $berita->judul }}"
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-all duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-slate-500/30 to-blue-500/30 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-.586-1.414l-4.5-4.5A2 2 0 0012.586 3H9"/>
                                        </svg>
                                    </div>
                                @endif
                                @if($berita->is_featured)
                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-1 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-xs font-semibold rounded-full">
                                            Featured
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="text-xl font-bold text-indigo-700 group-hover:text-indigo-500 transition-colors mb-2 line-clamp-2">
                                    {{ $berita->judul }}
                                </h3>
                                <div class="flex items-center text-sm text-gray-700 mb-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $berita->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <p class="text-gray-800 text-sm line-clamp-3">
                                    {!! Str::limit(strip_tags($berita->konten), 150) !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Agenda Column -->
            <div class="lg:col-span-1">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-indigo-700">Agenda Mendatang</h3>
                    <a href="#" class="text-indigo-700 hover:text-indigo-500 text-sm font-semibold">Lihat Semua</a>
                </div>

                <div class="space-y-3">
                    @foreach($agendas as $agenda)
                        <div class="glass-card rounded-xl p-3 hover:bg-white/5 transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <!-- Tanggal -->
                                <div class="flex-shrink-0 w-14 text-center">
                                    <div class="bg-indigo-500/20 rounded-lg p-2">
                                        <span class="block text-xs text-indigo-700 font-semibold">
                                            {{ $agenda->tanggal_mulai->format('M') }}
                                        </span>
                                        <span class="block text-2xl font-bold text-indigo-900">
                                            {{ $agenda->tanggal_mulai->format('d') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Konten -->
                                <div class="flex-1">
                                    <h4 class="text-base font-semibold text-indigo-800 mb-1 line-clamp-2">{{ $agenda->judul }}</h4>
                                    <div class="space-y-2 text-sm text-gray-700">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $agenda->tanggal_mulai->format('H:i') }} - 
                                            {{ $agenda->tanggal_selesai->format('H:i') }} WIB
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $agenda->lokasi }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $agenda->status === 'upcoming' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($agenda->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
