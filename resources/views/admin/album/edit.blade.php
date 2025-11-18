<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Edit Album') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update album information</p>
            </div>
            <button onclick="history.back()" 
                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-bold rounded-lg transition-all duration-300 hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <form action="{{ route('admin.album.update', $album->album_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="previous_url" value="{{ url()->previous() }}">

                        <!-- Album Name -->
                        <div>
                            <label for="album_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Album Name</label>
                            <input type="text" 
                                   name="album_name" 
                                   id="album_name" 
                                   value="{{ old('album_name', $album->album_name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors duration-200">
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
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors duration-200">{{ old('description', $album->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="kategori_id" 
                                    id="kategori_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors duration-200">
                                @foreach($categories as $category)
                                    <option value="{{ $category->kategori_id }}" 
                                            {{ old('kategori_id', $album->kategori_id) == $category->kategori_id ? 'selected' : '' }}>
                                        {{ $category->kategori_judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Parent Album -->
                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parent Album (Optional)</label>
                            <select name="parent_id" 
                                    id="parent_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors duration-200">
                                <option value="">No Parent</option>
                                @foreach($parentAlbums as $parentAlbum)
                                    @if($parentAlbum->album_id != $album->album_id)
                                        <option value="{{ $parentAlbum->album_id }}" 
                                                {{ old('parent_id', $album->parent_id) == $parentAlbum->album_id ? 'selected' : '' }}>
                                            {{ $parentAlbum->album_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cover Image -->
                        <div>
                            <label for="cover_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cover Image</label>
                            @if($album->cover_image)
                                <div class="mt-2 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                    <img src="{{ asset('storage/' . $album->cover_image) }}" 
                                         alt="Current cover" 
                                         class="h-32 w-32 object-cover rounded-lg">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        Current cover image
                                    </div>
                                </div>
                            @endif
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
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave empty to keep current image</p>
                            </div>
                            @error('cover_image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview Image -->
                        <div class="mt-4 hidden" id="imagePreview">
                            <img src="" alt="Preview" class="max-w-xs rounded-lg shadow-lg">
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                            <button type="button"
                                    onclick="history.back()"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                Update Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Image preview functionality
        document.getElementById('cover_image').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
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
    </script>
    @endpush
</x-app-layout> 