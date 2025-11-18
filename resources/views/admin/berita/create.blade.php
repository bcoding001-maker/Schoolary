<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Berita') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden relative">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-full opacity-20 blur-xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full opacity-20 blur-xl"></div>

                <div class="p-4 sm:p-8">
                    <form method="POST" 
                          action="{{ route('admin.berita.store') }}" 
                          enctype="multipart/form-data" 
                          id="createForm"
                          class="space-y-4 sm:space-y-6">
                        @csrf
                        
                        <!-- Grid Container untuk Form -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Kolom Kiri -->
                            <div class="space-y-4 sm:space-y-6">
                                <!-- Judul -->
                                <div class="relative group">
                                    <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Judul Berita
                                    </label>
                                    <input type="text" 
                                           name="judul" 
                                           id="judul" 
                                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 text-sm sm:text-base"
                                           value="{{ old('judul') }}"
                                           required>
                                    @error('judul')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Konten -->
                                <div class="relative group">
                                    <label for="konten" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Konten Berita
                                    </label>
                                    <textarea name="konten" 
                                              id="konten" 
                                              rows="8"
                                              class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 text-sm sm:text-base"
                                              required>{{ old('konten') }}</textarea>
                                    @error('konten')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="space-y-4 sm:space-y-6">
                                <!-- Thumbnail -->
                                <div class="relative group">
                                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Banner Berita
                                    </label>
                                    <div class="mt-1">
                                        <input type="file" 
                                               name="thumbnail" 
                                               id="thumbnail"
                                               accept="image/*"
                                               class="block w-full text-sm text-gray-500 dark:text-gray-400
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-full file:border-0
                                                      file:text-sm file:font-semibold
                                                      file:bg-indigo-50 file:text-indigo-700
                                                      hover:file:bg-indigo-100
                                                      dark:file:bg-indigo-900 dark:file:text-indigo-300"
                                               onchange="previewImage(event)"
                                               required>
                                    </div>
                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="mt-4 hidden">
                                        <div class="relative inline-block">
                                            <img id="preview" 
                                                 src="#" 
                                                 alt="Preview" 
                                                 class="rounded-lg shadow-lg max-w-full h-auto max-h-[200px] object-contain">
                                            <button type="button" 
                                                    onclick="handleRemoveImage(event)"
                                                    class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    @error('thumbnail')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status dan Featured dalam satu container -->
                                <div class="space-y-4">
                                    <!-- Status -->
                                    <div class="relative group">
                                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Status
                                        </label>
                                        <select name="status" 
                                                id="status" 
                                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 text-sm sm:text-base">
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Featured Post -->
                                    <div class="relative flex items-center">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" 
                                                   name="is_featured" 
                                                   id="is_featured"
                                                   value="1"
                                                   class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                                   {{ old('is_featured') ? 'checked' : '' }}>
                                        </div>
                                        <div class="ml-3">
                                            <label for="is_featured" class="font-medium text-gray-700 dark:text-gray-300 text-sm sm:text-base">Featured Post</label>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm">Tampilkan sebagai berita utama</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol aksi -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6">
                            <a href="{{ route('admin.berita.index') }}" 
                               class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-all duration-200">
                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Batal
                            </a>
                            <button type="button"
                                    onclick="handleSubmit(event)"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script untuk handling form -->
    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleRemoveImage(e) {
            e.preventDefault();
            const input = document.getElementById('thumbnail');
            const preview = document.getElementById('imagePreview');
            input.value = '';
            preview.classList.add('hidden');
        }

        function handleSubmit(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: "Apakah Anda yakin ingin menyimpan berita ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal',
                customClass: {
                    container: 'swal-mobile'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('createForm').submit();
                }
            });
        }

        // Tampilkan SweetAlert untuk pesan sukses/error dari session
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    container: 'swal-mobile'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                customClass: {
                    container: 'swal-mobile'
                }
            });
        @endif
    </script>

    <!-- Style untuk SweetAlert di mobile -->
    <style>
        @media (max-width: 640px) {
            .swal-mobile {
                padding: 0 1rem;
            }
            .swal2-popup {
                font-size: 0.875rem !important;
                padding: 1rem;
                width: 90% !important;
                margin: 0 auto;
            }
            .swal2-title {
                font-size: 1.25rem !important;
            }
            .swal2-content {
                font-size: 0.875rem !important;
            }
            .swal2-actions {
                gap: 0.5rem;
            }
            .swal2-actions button {
                font-size: 0.875rem !important;
                padding: 0.5rem 1rem !important;
                min-height: 44px;
                min-width: 44px;
            }
        }

        /* Perbaikan untuk touch targets */
        button {
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }
    </style>
</x-app-layout>
