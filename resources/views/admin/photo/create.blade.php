<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Add Photos to Album:') }} {{ $album->album_name }}
                </h2>
                    <p class="mt-1 text-sm text-gray-500">Upload multiple photos to this album</p>
            </div>
            <a href="{{ route('admin.album.show', $album->album_id) }}" 
               class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-bold rounded-lg transition-all duration-300 hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Album
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <form action="{{ route('admin.photo.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $album->album_id }}">

                        <!-- Title Prefix -->
                        <div>
                            <x-input-label for="title_prefix" :value="__('Title Prefix (for multiple photos)')" />
                            <x-text-input id="title_prefix" 
                                         name="title_prefix" 
                                         type="text" 
                                         class="mt-1 block w-full" 
                                         :value="old('title_prefix')" 
                                         placeholder="e.g., Event 2024"/>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Photos will be titled: [Prefix] - Photo 1, [Prefix] - Photo 2, etc.</p>
                        </div>

                        <!-- Multiple Images -->
                        <div>
                            <x-input-label for="images" :value="__('Photos (You can select multiple files)')" />
                            <div class="mt-2">
                                <!-- Custom File Upload Button -->
                                <div class="flex items-center justify-center w-full">
                                    <label for="images" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 transition-all duration-200">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-12 h-12 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG, GIF, WEBP (MAX. 10MB per file)</p>
                                            <p class="mt-2 text-xs text-indigo-600 dark:text-indigo-400 font-semibold">
                                                <span class="hidden sm:inline">Hold Ctrl (Windows) or Cmd (Mac) to select multiple files</span>
                                                <span class="sm:hidden">Tap to select multiple photos</span>
                                            </p>
                                        </div>
                                        <input type="file" 
                                               id="images" 
                                               name="images[]" 
                                               accept="image/png,image/jpg,image/jpeg,image/gif,image/webp" 
                                               multiple
                                               class="hidden"
                                               required />
                                    </label>
                                </div>
                                
                                <!-- Selected Files Count -->
                                <div id="fileCount" class="mt-3 text-sm text-gray-600 dark:text-gray-400 hidden">
                                    <span class="font-semibold text-indigo-600 dark:text-indigo-400" id="fileCountText">0 files selected</span>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Images -->
                        <div id="imagePreview" class="hidden mt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Preview</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="previewGrid"></div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6">
                            <a href="{{ route('admin.album.show', $album->album_id) }}"
                               class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Upload Photos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const imageInput = document.getElementById('images');
        const previewGrid = document.getElementById('previewGrid');
        const previewContainer = document.getElementById('imagePreview');
        const fileCount = document.getElementById('fileCount');
        const fileCountText = document.getElementById('fileCountText');
        const dropZone = document.querySelector('label[for="images"]');

        // Handle file selection
        imageInput.addEventListener('change', function(e) {
            handleFiles(this.files);
        });

        // Drag and drop handlers
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
            
            const files = e.dataTransfer.files;
            imageInput.files = files; // Set files to input
            handleFiles(files);
        });

        function handleFiles(files) {
            previewGrid.innerHTML = ''; // Clear previous previews
            
            if (files.length > 0) {
                // Show file count
                fileCount.classList.remove('hidden');
                fileCountText.textContent = `${files.length} file${files.length > 1 ? 's' : ''} selected`;
                
                // Show preview container
                previewContainer.classList.remove('hidden');
                
                // Create previews
                Array.from(files).forEach((file, index) => {
                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        console.warn(`File ${file.name} is not an image`);
                        return;
                    }

                    const reader = new FileReader();
                    const previewCard = document.createElement('div');
                    previewCard.className = 'relative group';
                    
                    reader.onload = function(e) {
                        previewCard.innerHTML = `
                            <div class="relative aspect-square rounded-lg overflow-hidden shadow-md bg-gray-100 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600">
                                <img src="${e.target.result}" 
                                     class="w-full h-full object-cover" 
                                     alt="Preview ${index + 1}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-3">
                                    <div class="text-white text-center px-2">
                                        <p class="text-sm font-semibold">Photo ${index + 1}</p>
                                        <p class="text-xs mt-1">${formatFileSize(file.size)}</p>
                                        <p class="text-xs mt-0.5 truncate max-w-full">${file.name}</p>
                                    </div>
                                </div>
                                <div class="absolute top-2 right-2 bg-indigo-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                    ${index + 1}
                                </div>
                            </div>
                        `;
                    }
                    
                    reader.readAsDataURL(file);
                    previewGrid.appendChild(previewCard);
                });
            } else {
                previewContainer.classList.add('hidden');
                fileCount.classList.add('hidden');
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Prevent default drag behavior on document
        document.addEventListener('dragover', function(e) {
            e.preventDefault();
        });
        
        document.addEventListener('drop', function(e) {
            e.preventDefault();
        });
    </script>
    @endpush
</x-app-layout> 