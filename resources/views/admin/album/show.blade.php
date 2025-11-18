<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $album->album_name }}
                </h2>
                @if($albumDepth > 0)
                    <p class="mt-1 text-sm text-gray-500">
                        Level {{ $albumDepth }} dari 3 
                        @if(!$canCreateSubAlbum)
                            (Maksimum level tercapai)
                        @endif
                    </p>
                @endif
            </div>
            <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                @if($canCreateSubAlbum)
                    <button onclick="toggleSubAlbumForm()" 
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold rounded-lg transition-all duration-300 hover:from-purple-600 hover:to-indigo-700 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add Sub Album
                    </button>
                @endif
                @if($album->parent_id)
                    {{-- Jika ada parent, kembali ke parent album --}}
                    <a href="{{ route('admin.album.show', $album->parent_id) }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-bold rounded-lg transition-all duration-300 hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Parent Album
                    </a>
                @else
                    {{-- Jika tidak ada parent, kembali ke gallery index --}}
                    <a href="{{ route('admin.album.index') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-bold rounded-lg transition-all duration-300 hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Gallery
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <!-- Alert Success -->
        @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <div class="relative flex items-center justify-between p-4 text-green-800 border-l-4 border-green-300 bg-green-50 dark:text-green-400 dark:border-green-500 dark:bg-gray-800" 
                 x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 3000)"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form untuk membuat sub album (hidden by default) -->
            <div id="subAlbumForm" class="hidden mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Create Sub Album</h3>
                            <button onclick="toggleSubAlbumForm()" 
                                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <form action="{{ route('admin.album.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $album->album_id }}">
                            <input type="hidden" name="kategori_id" value="{{ $album->kategori_id }}">

                            <!-- Album Name -->
                            <div>
                                <label for="album_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Album Name</label>
                                <input type="text" 
                                       name="album_name" 
                                       id="album_name" 
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors duration-200"
                                       required>
                                @error('album_name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="4"
                                          class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors duration-200"></textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cover Image -->
                            <div>
                                <label for="cover_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cover Image</label>
                                <div class="mt-2">
                                    <input type="file" 
                                           name="cover_image" 
                                           id="cover_image"
                                           accept="image/*"
                                           class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-lg file:border-0
                                                  file:text-sm file:font-medium
                                                  file:bg-indigo-50 file:text-indigo-700
                                                  hover:file:bg-indigo-100
                                                  dark:file:bg-indigo-900 dark:file:text-indigo-300
                                                  dark:hover:file:bg-indigo-800
                                                  transition-colors duration-200">
                                </div>
                                @error('cover_image')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Preview Image -->
                            <div class="mt-4 hidden" id="subAlbumImagePreview">
                                <div class="relative w-full max-w-sm">
                                    <img src="" alt="Preview" class="rounded-lg shadow-lg w-full aspect-video object-cover">
                                    <button type="button" 
                                            onclick="clearImagePreview()"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                                <button type="button"
                                        onclick="toggleSubAlbumForm()"
                                        class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Create Sub Album
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Album Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                        <!-- Cover Image -->
                        <div class="w-full md:w-1/4">
                            @if($album->cover_image)
                                <img src="{{ asset('storage/' . $album->cover_image) }}" 
                                     alt="{{ $album->album_name }}" 
                                     class="w-full rounded-lg shadow-lg object-cover aspect-[4/3]">
                            @else
                                <div class="w-full aspect-[4/3] bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-16 h-16 text-indigo-300 dark:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Album Info -->
                        <div class="w-full md:w-3/4">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $album->album_name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $album->description }}</p>
                            <div class="mt-4 space-y-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    Category: {{ $album->kategori->kategori_judul }}
                                </span>
                                @if($album->parent)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                        Parent Album: {{ $album->parent->album_name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sub Albums Section -->
            @if($album->children->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Sub Albums</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $album->children->count() }} {{ Str::plural('sub album', $album->children->count()) }}
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                                <button onclick="toggleSubAlbumSelectMode()" 
                                        id="selectSubAlbumBtn"
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-lg transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    Select Sub Albums
                                </button>
                                <button id="deleteSelectedSubAlbumsBtn" 
                                        onclick="deleteSelectedSubAlbums()"
                                        class="hidden w-full sm:w-auto items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-lg transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete Selected
                                </button>
                            </div>
                        </div>

                        <!-- Sub Albums Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            @foreach($album->children as $subAlbum)
                                <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-all duration-300">
                                    <!-- Checkbox for selection -->
                                    <div class="absolute top-2 right-2 z-10 hidden select-subalbum-checkbox">
                                        <input type="checkbox" 
                                               name="selected_albums[]" 
                                               value="{{ $subAlbum->album_id }}"
                                               class="w-5 h-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>

                                    <!-- Album Preview -->
                                    <div class="relative aspect-video rounded-t-xl overflow-hidden">
                                        @if($subAlbum->cover_image)
                                            <img src="{{ asset('storage/' . $subAlbum->cover_image) }}" 
                                                 alt="{{ $subAlbum->album_name }}" 
                                                 class="w-full h-full object-cover">
                                        @elseif($subAlbum->photos->count() > 0)
                                            <!-- Show first photo as cover if no cover image -->
                                            <img src="{{ asset('storage/' . $subAlbum->photos->first()->image_path) }}" 
                                                 alt="{{ $subAlbum->album_name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-indigo-500/30 to-purple-500/30 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif

                                        <!-- Photo Preview Grid Overlay -->
                                        @if($subAlbum->photos->count() > 0)
                                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <div class="grid grid-cols-2 gap-1 p-2 h-full">
                                                    @foreach($subAlbum->photos->take(4) as $photo)
                                                        <div class="aspect-square rounded overflow-hidden">
                                                            <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                                                 alt="{{ $photo->title }}"
                                                                 class="w-full h-full object-cover">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Album Info -->
                                    <div class="p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $subAlbum->album_name }}
                                            </h4>
                                            <form action="{{ route('admin.album.destroy', $subAlbum->album_id) }}" 
                                                  method="POST" 
                                                  class="ml-2" 
                                                  onsubmit="return confirm('Are you sure you want to delete this album and all its contents?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-500 hover:text-red-700 p-1.5 rounded-full hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors duration-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        @if($subAlbum->description)
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2">
                                                {{ $subAlbum->description }}
                                            </p>
                                        @endif

                                        <!-- Stats & Actions -->
                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ $subAlbum->photos->count() }} Photos
                                                </span>
                                                @if($subAlbum->children->count() > 0)
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                        </svg>
                                                        {{ $subAlbum->children->count() }} Sub Albums
                                                    </span>
                                                @endif
                                            </div>

                                            <a href="{{ route('admin.album.show', $subAlbum->album_id) }}" 
                                               class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                View Album
                                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Photos Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Photos</h3>
                        <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                            <button onclick="toggleSelectMode()" 
                                    id="selectModeBtn"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-lg transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Select Photos
                            </button>
                            <button id="deleteSelectedBtn" 
                                    onclick="deleteSelected()"
                                    class="hidden w-full sm:w-auto items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-lg transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Selected
                            </button>
                            <a href="{{ route('admin.photo.create', ['album_id' => $album->album_id]) }}" 
                               class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg text-white transition-all duration-300 hover:from-green-600 hover:to-emerald-700 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Photos
                            </a>
                        </div>
                    </div>

                    <!-- Photos Grid -->
                    @if($album->photos->count() > 0)
                        <form id="deleteForm" action="{{ route('admin.photo.destroy.multiple') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                                @foreach($album->photos as $photo)
                                    <div class="relative group photo-card-wrapper" data-photo-id="{{ $photo->id }}">
                                        <!-- Checkbox for selection (kept for form submission, visually hidden) -->
                                        <div class="absolute top-2 left-2 z-20 hidden select-checkbox" onclick="event.stopPropagation();">
                                            <label class="inline-block" onclick="event.stopPropagation();">
                                                <input type="checkbox" 
                                                       name="selected_photos[]" 
                                                       value="{{ $photo->id }}"
                                                       onchange="handleCheckboxChange(this, event)"
                                                       onclick="event.stopPropagation();"
                                                       class="w-0 h-0 opacity-0 pointer-events-none">
                                            </label>
                                        </div>
                                        
                                        <!-- Photo Card -->
                                        <div class="photo-card relative aspect-square overflow-hidden rounded-lg shadow-lg cursor-pointer bg-gray-200 dark:bg-gray-700"
                                             onclick="handlePhotoClick(event, this, {{ $photo->id }})"
                                             data-photo-url="{{ asset('storage/' . $photo->image_path) }}"
                                             data-photo-title="{{ $photo->title }}"
                                             data-photo-description="{{ $photo->description }}">
                                            <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                                 alt="{{ $photo->title }}" 
                                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                            
                                            <!-- Hover Overlay -->
                                            <div class="hover-overlay absolute inset-0 bg-gradient-to-t from-black/70 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                                    <h4 class="text-white font-semibold truncate">{{ $photo->title }}</h4>
                                                    <p class="text-gray-200 text-sm line-clamp-2">{{ $photo->description }}</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Selection Overlay -->
                                            <div class="selection-overlay absolute inset-0 bg-indigo-500 bg-opacity-30 hidden pointer-events-none transition-all duration-200">
                                                <div class="absolute top-2 right-2 bg-indigo-600 text-white rounded-full p-1.5 shadow-lg">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">No photos in this album yet.</p>
                            <div class="mt-4">
                                <a href="{{ route('admin.photo.create', ['album_id' => $album->album_id]) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Add Photos
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" 
         class="fixed inset-0 bg-black/90 hidden z-50" 
         onclick="closeLightbox()"
         x-data="{ currentIndex: 0 }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        
        <!-- Navigation Buttons -->
        <button onclick="event.stopPropagation(); previousImage()" 
                class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-50">
            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <button onclick="event.stopPropagation(); nextImage()" 
                class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-50">
            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <div class="flex items-center justify-center h-full">
            <div class="max-w-4xl w-full px-4" onclick="event.stopPropagation()">
                <img id="lightbox-image" src="" alt="" class="max-h-[70vh] mx-auto rounded-lg shadow-2xl">
                <div class="mt-4 text-center">
                    <h3 id="lightbox-title" class="text-xl font-bold text-white"></h3>
                    <p id="lightbox-description" class="mt-2 text-gray-300"></p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Ensure DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded - initializing album functions');
        });

        let currentImageIndex = 0;
        const images = @json($album->photos->map(function($photo) {
            return [
                'url' => asset('storage/' . $photo->image_path),
                'title' => $photo->title,
                'description' => $photo->description
            ];
        }));

        function openLightbox(imageUrl, title, description) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxTitle = document.getElementById('lightbox-title');
            const lightboxDescription = document.getElementById('lightbox-description');

            currentImageIndex = images.findIndex(img => img.url === imageUrl);
            
            lightboxImage.src = imageUrl;
            lightboxTitle.textContent = title;
            lightboxDescription.textContent = description;
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function previousImage() {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            updateLightboxImage();
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            updateLightboxImage();
        }

        function updateLightboxImage() {
            const image = images[currentImageIndex];
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxTitle = document.getElementById('lightbox-title');
            const lightboxDescription = document.getElementById('lightbox-description');

            lightboxImage.src = image.url;
            lightboxTitle.textContent = image.title;
            lightboxDescription.textContent = image.description;
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (document.getElementById('lightbox').classList.contains('hidden')) return;
            
            if (e.key === 'ArrowLeft') previousImage();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'Escape') closeLightbox();
        });

        // SELECT PHOTOS FUNCTIONALITY
        let selectMode = false;

        // Make function globally accessible
        window.toggleSelectMode = function() {
            console.log('toggleSelectMode called, current mode:', selectMode);
            selectMode = !selectMode;
            
            const checkboxes = document.querySelectorAll('.select-checkbox');
            const deleteBtn = document.getElementById('deleteSelectedBtn');
            const selectBtn = document.getElementById('selectModeBtn');
            
            console.log('Found elements:', {
                checkboxes: checkboxes.length,
                deleteBtn: deleteBtn ? 'found' : 'not found',
                selectBtn: selectBtn ? 'found' : 'not found'
            });

            if (selectMode) {
                // ENTER SELECT MODE
                checkboxes.forEach(cb => cb.classList.remove('hidden'));
                deleteBtn.classList.remove('hidden');
                deleteBtn.classList.add('inline-flex');
                selectBtn.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>Cancel';
                selectBtn.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                selectBtn.classList.add('bg-gray-500', 'hover:bg-gray-700');
            } else {
                // EXIT SELECT MODE
                checkboxes.forEach(cb => cb.classList.add('hidden'));
                deleteBtn.classList.add('hidden');
                deleteBtn.classList.remove('inline-flex');
                selectBtn.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>Select Photos';
                selectBtn.classList.add('bg-blue-500', 'hover:bg-blue-700');
                selectBtn.classList.remove('bg-gray-500', 'hover:bg-gray-700');
                
                // Uncheck all
                document.querySelectorAll('input[name="selected_photos[]"]').forEach(cb => {
                    cb.checked = false;
                    const wrapper = cb.closest('.photo-card-wrapper');
                    const overlay = wrapper.querySelector('.selection-overlay');
                    if (overlay) overlay.classList.add('hidden');
                });
            }
        };

        window.handlePhotoClick = function(e, element, photoId) {
            if (e) e.stopPropagation();
            
            if (selectMode) {
                // Toggle checkbox
                const wrapper = element.closest('.photo-card-wrapper');
                const checkbox = wrapper.querySelector('input[type="checkbox"]');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    const overlay = wrapper.querySelector('.selection-overlay');
                    if (overlay) {
                        if (checkbox.checked) {
                            overlay.classList.remove('hidden');
                        } else {
                            overlay.classList.add('hidden');
                        }
                    }
                }
            } else {
                // Open lightbox
                openLightbox(element.dataset.photoUrl, element.dataset.photoTitle, element.dataset.photoDescription);
            }
        };

        window.handleCheckboxChange = function(checkbox, e) {
            if (e) e.stopPropagation();
            const wrapper = checkbox.closest('.photo-card-wrapper');
            const overlay = wrapper.querySelector('.selection-overlay');
            if (overlay) {
                if (checkbox.checked) {
                    overlay.classList.remove('hidden');
                } else {
                    overlay.classList.add('hidden');
                }
            }
        };

        window.deleteSelected = function() {
            const selectedPhotos = document.querySelectorAll('input[name="selected_photos[]"]:checked');
            if (selectedPhotos.length === 0) {
                alert('Please select at least one photo to delete');
                return;
            }

            if (confirm(`Are you sure you want to delete ${selectedPhotos.length} selected photos?`)) {
                document.getElementById('deleteForm').submit();
            }
        };

        // Sub Album Selection Functions
        let subAlbumSelectMode = false;

        function toggleSubAlbumSelectMode() {
            subAlbumSelectMode = !subAlbumSelectMode;
            const checkboxes = document.querySelectorAll('.select-subalbum-checkbox');
            const deleteBtn = document.getElementById('deleteSelectedSubAlbumsBtn');
            const selectBtn = document.getElementById('selectSubAlbumBtn');

            checkboxes.forEach(checkbox => {
                checkbox.classList.toggle('hidden');
            });

            if (subAlbumSelectMode) {
                deleteBtn.classList.remove('hidden');
                deleteBtn.classList.add('inline-flex');
                // Update button text with icon
                selectBtn.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancel Selection
                `;
                selectBtn.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                selectBtn.classList.add('bg-gray-500', 'hover:bg-gray-700');
            } else {
                deleteBtn.classList.add('hidden');
                deleteBtn.classList.remove('inline-flex');
                // Reset button text with icon
                selectBtn.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Select Sub Albums
                `;
                selectBtn.classList.add('bg-blue-500', 'hover:bg-blue-700');
                selectBtn.classList.remove('bg-gray-500', 'hover:bg-gray-700');
                // Uncheck all checkboxes
                document.querySelectorAll('input[name="selected_albums[]"]').forEach(cb => cb.checked = false);
            }
        }

        function deleteSelectedSubAlbums() {
            const selectedAlbums = document.querySelectorAll('input[name="selected_albums[]"]:checked');
            if (selectedAlbums.length === 0) {
                alert('Please select at least one sub album to delete');
                return;
            }

            if (confirm(`Are you sure you want to delete ${selectedAlbums.length} selected sub albums? All photos and nested sub-albums will also be deleted.`)) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.album.destroy.multiple") }}';
                
                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
                
                // Add method spoofing for DELETE
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                // Add selected album IDs
                selectedAlbums.forEach(checkbox => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_albums[]';
                    input.value = checkbox.value;
                    form.appendChild(input);
                });
                
                document.body.appendChild(form);
                form.submit();
            }
        }


        window.toggleSubAlbumForm = function() {
            console.log('toggleSubAlbumForm called');
            const form = document.getElementById('subAlbumForm');
            console.log('Form element:', form ? 'found' : 'not found');
            
            if (form.classList.contains('hidden')) {
                // Show form with animation
                form.classList.remove('hidden');
                form.classList.add('animate-fade-in-down');
                // Scroll to form smoothly
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Focus on album name input
                document.getElementById('album_name').focus();
            } else {
                // Hide form with animation
                form.classList.add('animate-fade-out-up');
                setTimeout(() => {
                    form.classList.add('hidden');
                    form.classList.remove('animate-fade-out-up');
                    // Clear form
                    form.querySelector('form').reset();
                    document.getElementById('subAlbumImagePreview').classList.add('hidden');
                }, 200);
            }
        };

        // Image preview for sub album
        document.getElementById('cover_image').addEventListener('change', function(e) {
            const preview = document.getElementById('subAlbumImagePreview');
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.querySelector('img').src = e.target.result;
                preview.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        function clearImagePreview() {
            const preview = document.getElementById('subAlbumImagePreview');
            preview.classList.add('hidden');
            document.getElementById('cover_image').value = '';
        }

        // Add keydown event for Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const form = document.getElementById('subAlbumForm');
                if (!form.classList.contains('hidden')) {
                    toggleSubAlbumForm();
                }
            }
        });
    </script>
    @endpush

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-out-up {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.2s ease-out forwards;
        }

        .animate-fade-out-up {
            animation: fade-out-up 0.2s ease-out forwards;
        }
    </style>
</x-app-layout> 