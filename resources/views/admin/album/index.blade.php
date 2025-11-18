<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Gallery Management') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your photo albums and collections</p>
            </div>
            <div class="w-full sm:w-auto">
                <a href="{{ route('admin.album.create') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-lg text-white transition-all duration-300 hover:from-purple-600 hover:to-indigo-700 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Album
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <!-- Alert Success -->
        @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
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

        <!-- Alert Error -->
        @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="relative flex items-center justify-between p-4 text-red-800 border-l-4 border-red-300 bg-red-50 dark:text-red-400 dark:border-red-500 dark:bg-gray-800"
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
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
            <!-- Category Tabs Section -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg mb-6">
                <div class="p-4">
                    <!-- Desktop Tabs -->
                    <div class="hidden md:flex md:flex-wrap gap-2">
                        <!-- All Albums Tab -->
                        <button onclick="showCategory('all-albums')"
                                class="category-tab px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-sm font-medium transition-all duration-300
                                       bg-indigo-500 text-white
                                       hover:bg-indigo-50 hover:text-indigo-600 dark:hover:bg-indigo-900 dark:hover:text-indigo-400
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            All Albums
                            <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-white/20 text-white">
                                {{ $categories->sum(function($category) { return $category->albums->count(); }) }}
                            </span>
                        </button>
                        
                        @foreach($categories as $category)
                            <button onclick="showCategory('category-{{ $category->kategori_id }}')"
                                    class="category-tab px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-sm font-medium transition-all duration-300
                                           hover:bg-indigo-50 hover:text-indigo-600 dark:hover:bg-indigo-900 dark:hover:text-indigo-400
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                           text-gray-600 dark:text-gray-300">
                                {{ $category->kategori_judul }}
                                <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-indigo-100 text-indigo-600 dark:bg-indigo-900 dark:text-indigo-400">
                                    {{ $category->albums->count() }}
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <!-- Mobile View - Grid Cards -->
                    <div class="md:hidden">
                        <div class="grid grid-cols-2 gap-2">
                            <!-- All Albums Card -->
                            <button onclick="showCategory('all-albums')"
                                    class="mobile-category-tab w-full px-3 py-2.5 rounded-lg text-sm font-medium
                                           flex flex-col items-center justify-center space-y-1 transition-all duration-300
                                           bg-indigo-500 text-white">
                                <span class="text-center">All Albums</span>
                                <span class="px-2 py-0.5 text-xs rounded-full bg-white/20 text-white">
                                    {{ $categories->sum(function($category) { return $category->albums->count(); }) }}
                                </span>
                            </button>

                            @foreach($categories as $category)
                                <button onclick="showCategory('category-{{ $category->kategori_id }}')"
                                        class="mobile-category-tab w-full px-3 py-2.5 rounded-lg text-sm font-medium
                                               flex flex-col items-center justify-center space-y-1 transition-all duration-300
                                               bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300
                                               hover:bg-indigo-50 hover:text-indigo-600 dark:hover:bg-indigo-900 dark:hover:text-indigo-400">
                                    <span class="text-center">{{ $category->kategori_judul }}</span>
                                    <span class="px-2 py-0.5 text-xs rounded-full bg-indigo-100 text-indigo-600 dark:bg-indigo-900 dark:text-indigo-400">
                                        {{ $category->albums->count() }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Albums Grid -->
            <div id="all-albums" class="category-content">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                    @foreach($categories as $category)
                        @foreach($category->albums as $album)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden group hover:shadow-lg transition-all duration-300">
                                <!-- Album Cover -->
                                <div class="relative aspect-[4/3]">
                                    @if($album->cover_image)
                                        <img src="{{ asset('storage/' . $album->cover_image) }}" 
                                             alt="{{ $album->album_name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 flex items-center justify-center">
                                            <svg class="w-12 h-12 sm:w-16 sm:h-16 text-indigo-300 dark:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <div class="flex flex-wrap justify-center gap-2 sm:gap-4 p-2">
                                            <a href="{{ route('admin.album.show', $album->album_id) }}" 
                                               class="p-1.5 sm:p-2 bg-white rounded-full hover:bg-indigo-500 hover:text-white transition-colors duration-300">
                                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.album.edit', $album->album_id) }}" 
                                               class="p-1.5 sm:p-2 bg-white rounded-full hover:bg-yellow-500 hover:text-white transition-colors duration-300">
                                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button onclick="confirmDelete({{ $album->album_id }}, '{{ $album->album_name }}')"
                                                    class="p-1.5 sm:p-2 bg-white rounded-full hover:bg-red-500 hover:text-white transition-colors duration-300">
                                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Album Info -->
                                <div class="p-3 sm:p-4">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
                                        {{ $album->album_name }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                        {{ $album->description ?? 'No description available' }}
                                    </p>
                                    
                                    <!-- Stats -->
                                    <div class="mt-3 sm:mt-4 flex items-center justify-between text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $album->photos->count() }} Photos
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                            {{ $album->children->count() }} Sub-albums
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <!-- Category Sections -->
            @foreach($categories as $category)
                <div id="category-{{ $category->kategori_id }}" class="category-content hidden">
                    @if($category->albums->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                            @foreach($category->albums as $album)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden group hover:shadow-lg transition-all duration-300">
                                    <!-- Album Cover -->
                                    <div class="relative aspect-[4/3]">
                                        @if($album->cover_image)
                                            <img src="{{ asset('storage/' . $album->cover_image) }}" 
                                                 alt="{{ $album->album_name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 flex items-center justify-center">
                                                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-indigo-300 dark:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <!-- Hover Overlay -->
                                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <div class="flex flex-wrap justify-center gap-2 sm:gap-4 p-2">
                                                <a href="{{ route('admin.album.show', $album->album_id) }}" 
                                                   class="p-1.5 sm:p-2 bg-white rounded-full hover:bg-indigo-500 hover:text-white transition-colors duration-300">
                                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.album.edit', $album->album_id) }}" 
                                                   class="p-1.5 sm:p-2 bg-white rounded-full hover:bg-yellow-500 hover:text-white transition-colors duration-300">
                                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <button onclick="confirmDelete({{ $album->album_id }}, '{{ $album->album_name }}')"
                                                        class="p-1.5 sm:p-2 bg-white rounded-full hover:bg-red-500 hover:text-white transition-colors duration-300">
                                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Album Info -->
                                    <div class="p-3 sm:p-4">
                                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
                                            {{ $album->album_name }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                            {{ $album->description ?? 'No description available' }}
                                        </p>
                                        
                                        <!-- Stats -->
                                        <div class="mt-3 sm:mt-4 flex items-center justify-between text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $album->photos->count() }} Photos
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                </svg>
                                                {{ $album->children->count() }} Sub-albums
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State untuk kategori -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 sm:p-8 text-center">
                            <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No albums in this category</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new album in this category.</p>
                            <div class="mt-4 sm:mt-6">
                                <a href="{{ route('admin.album.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Create New Album
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" 
         class="fixed inset-0 z-50 hidden"
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity ease-out duration-300"></div>

        <!-- Modal panel -->
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all duration-300 ease-out sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 id="modalContent">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- Warning Icon -->
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>

                        <!-- Modal Content -->
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100" id="modal-title">
                                Hapus Album
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Apakah Anda yakin ingin menghapus album "<span id="albumNameToDelete" class="font-medium text-gray-700 dark:text-gray-300"></span>"?
                                    <br>
                                    <span class="text-red-500">Semua data yang terkait akan dihapus secara permanen.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="bg-gray-50 dark:bg-gray-700/30 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <form id="deleteForm" method="POST" class="sm:ml-3 sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto
                                       transition duration-300 ease-in-out transform hover:scale-105">
                            Hapus Album
                        </button>
                    </form>
                    <button type="button"
                            onclick="closeDeleteModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto
                                   transition duration-300 ease-in-out transform hover:scale-105">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        /* Hide scrollbar but keep functionality */
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        function showCategory(categoryId) {
            // Hide all category contents
            document.querySelectorAll('.category-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show selected category content
            const selectedContent = document.getElementById(categoryId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }

            // Update desktop tabs
            document.querySelectorAll('.category-tab').forEach(tab => {
                if (tab.getAttribute('onclick').includes(categoryId)) {
                    tab.classList.remove('text-gray-600', 'dark:text-gray-300');
                    tab.classList.add('bg-indigo-500', 'text-white');
                } else {
                    tab.classList.remove('bg-indigo-500', 'text-white');
                    tab.classList.add('text-gray-600', 'dark:text-gray-300');
                }
            });

            // Update mobile cards
            document.querySelectorAll('.mobile-category-tab').forEach(tab => {
                if (tab.getAttribute('onclick').includes(categoryId)) {
                    tab.classList.remove('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-300');
                    tab.classList.add('bg-indigo-500', 'text-white');
                    
                    // Update badge color
                    const badge = tab.querySelector('span:last-child');
                    if (badge) {
                        badge.classList.remove('bg-indigo-100', 'text-indigo-600', 'dark:bg-indigo-900', 'dark:text-indigo-400');
                        badge.classList.add('bg-white/20', 'text-white');
                    }
                } else {
                    tab.classList.remove('bg-indigo-500', 'text-white');
                    tab.classList.add('bg-gray-100', 'text-gray-600', 'dark:bg-gray-700', 'dark:text-gray-300');
                    
                    // Reset badge color
                    const badge = tab.querySelector('span:last-child');
                    if (badge) {
                        badge.classList.add('bg-indigo-100', 'text-indigo-600', 'dark:bg-indigo-900', 'dark:text-indigo-400');
                        badge.classList.remove('bg-white/20', 'text-white');
                    }
                }
            });

            // Save selected category to localStorage
            localStorage.setItem('selectedCategory', categoryId);
        }

        // Initialize with saved category or default to all-albums
        document.addEventListener('DOMContentLoaded', function() {
            const savedCategory = localStorage.getItem('selectedCategory') || 'all-albums';
            showCategory(savedCategory);
        });

        function confirmDelete(albumId, albumName) {
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('modalContent');
            const deleteForm = document.getElementById('deleteForm');
            
            // Show modal and overlay with fade effect
            modal.classList.remove('hidden');
            
            // Animate modal content
            setTimeout(() => {
                modalContent.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                modalContent.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
            }, 50);
            
            // Set album name and form action
            document.getElementById('albumNameToDelete').textContent = albumName;
            const actionUrl = `{{ url('/admin/album') }}/${albumId}`;
            deleteForm.action = actionUrl;
            
            console.log('Delete URL:', actionUrl);
            console.log('Album ID:', albumId);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('modalContent');
            
            // Animate modal content out
            modalContent.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
            modalContent.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            
            // Hide modal after animation
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                closeDeleteModal();
            }
        });

        // Prevent modal from closing when clicking inside modal content
        document.querySelector('#modalContent').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
    @endpush
</x-app-layout> 