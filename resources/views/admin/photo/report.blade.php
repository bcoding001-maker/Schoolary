<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Laporan Foto') }}
                </h2>
            </div>
            <div class="w-full sm:w-auto flex gap-2 sm:gap-3">
                <a href="{{ route('admin.album.index') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Album
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Summary Cards (Agenda-style) -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                <!-- Total Foto -->
                <div class="col-span-2 md:col-span-1 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl p-4 sm:p-6 shadow-xl transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-white text-[11px] sm:text-xs font-medium uppercase tracking-wider">Total Foto</p>
                            <p class="text-white text-2xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $photos->total() }}
                            </p>
                            <p class="hidden sm:block text-white/80 text-xs mt-1">Foto yang tercatat dalam laporan ini.</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Likes -->
                <div class="col-span-2 md:col-span-1 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-4 sm:p-6 shadow-xl transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-white text-[11px] sm:text-xs font-medium uppercase tracking-wider">Total Likes (Halaman Ini)</p>
                            <p class="text-white text-2xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $photos->sum('likes_count') }}
                            </p>
                            <p class="hidden sm:block text-white/80 text-xs mt-1">Akumulasi like dari foto pada halaman ini.</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Views -->
                <div class="col-span-2 md:col-span-1 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-4 sm:p-6 shadow-xl transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 sm:w-40 sm:h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>

                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-white text-[11px] sm:text-xs font-medium uppercase tracking-wider">Total View (Halaman Ini)</p>
                            <p class="text-white text-2xl sm:text-4xl font-bold mt-1 sm:mt-2 group-hover:scale-110 transition-transform duration-300">
                                {{ $photos->sum('views_count') }}
                            </p>
                            <p class="hidden sm:block text-white/80 text-xs mt-1">Akumulasi jumlah dilihat dari foto pada halaman ini.</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-2 sm:p-3 transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-blue-50 dark:border-blue-900/40">
                <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-200">
                            Statistik Detail Foto
                        </h3>
                    </div>
                    <div class="text-xs sm:text-sm text-gray-400 dark:text-gray-500">
                        Halaman {{ $photos->currentPage() }} dari {{ $photos->lastPage() }}
                    </div>
                </div>

                <div class="p-3 sm:p-4">
                    <div class="overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-xs sm:text-sm">
                            <thead class="bg-blue-50/60 dark:bg-gray-900/60">
                                <tr>
                                    <th scope="col" class="px-3 sm:px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-400">#</th>
                                    <th scope="col" class="px-3 sm:px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-400">Album</th>
                                    <th scope="col" class="px-3 sm:px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-400">Judul Foto</th>
                                    <th scope="col" class="px-3 sm:px-4 py-2 text-center font-medium text-gray-500 dark:text-gray-400">Likes</th>
                                    <th scope="col" class="px-3 sm:px-4 py-2 text-center font-medium text-gray-500 dark:text-gray-400">Komentar</th>
                                    <th scope="col" class="px-3 sm:px-4 py-2 text-center font-medium text-gray-500 dark:text-gray-400">Dilihat</th>
                                    <th scope="col" class="px-3 sm:px-4 py-2 text-center font-medium text-gray-500 dark:text-gray-400">Dibuat</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($photos as $index => $photo)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/40">
                                        <td class="px-3 sm:px-4 py-2 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $photos->firstItem() + $index }}
                                        </td>
                                        <td class="px-3 sm:px-4 py-2 whitespace-nowrap align-top">
                                            <div class="flex flex-col">
                                                <span class="text-gray-800 dark:text-gray-200 font-medium">
                                                    {{ $photo->album->album_name ?? '-' }}
                                                </span>
                                                <span class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                                    ID Album: {{ $photo->album_id }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-3 sm:px-4 py-2 align-top">
                                            <div class="flex items-start gap-3">
                                                @if($photo->image_path)
                                                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}" class="w-10 h-10 rounded object-cover hidden sm:block shadow-sm">
                                                @endif
                                                <div class="flex flex-col">
                                                    <span class="text-gray-800 dark:text-gray-200 font-medium line-clamp-2">
                                                        {{ $photo->title }}
                                                    </span>
                                                    @if($photo->description)
                                                        <span class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 line-clamp-1 mt-0.5">
                                                            {{ $photo->description }}
                                                        </span>
                                                    @endif
                                                    <span class="mt-1 inline-flex items-center text-[11px] text-gray-400 dark:text-gray-500">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                                        </svg>
                                                        {{ optional($photo->created_at)->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 sm:px-4 py-2 text-center whitespace-nowrap align-top">
                                            <span class="inline-flex items-center justify-center px-2 py-1 rounded-full text-[11px] sm:text-xs font-semibold bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                                {{ $photo->likes_count ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-3 sm:px-4 py-2 text-center whitespace-nowrap align-top">
                                            <span class="inline-flex items-center justify-center px-2 py-1 rounded-full text-[11px] sm:text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
                                                {{ $photo->comments_count ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-3 sm:px-4 py-2 text-center whitespace-nowrap align-top">
                                            <span class="inline-flex items-center justify-center px-2 py-1 rounded-full text-[11px] sm:text-xs font-semibold bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                                                {{ $photo->views_count ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-3 sm:px-4 py-2 text-center whitespace-nowrap align-top text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                                            {{ optional($photo->created_at)->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-3 sm:px-4 py-6 text-center text-gray-500 dark:text-gray-400 text-sm">
                                            Belum ada data foto yang dapat ditampilkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Menampilkan {{ $photos->count() }} dari {{ $photos->total() }} foto.
                        </div>
                        <div>
                            {{ $photos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
