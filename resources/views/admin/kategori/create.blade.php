<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-xl overflow-hidden relative">
                <!-- Decorative Elements - Hidden on mobile for cleaner look -->
                <div class="hidden sm:block absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full opacity-20 blur-xl"></div>
                <div class="hidden sm:block absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full opacity-20 blur-xl"></div>

                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- Form Header -->
                    <div class="flex items-center space-x-3 sm:space-x-6 mb-6 sm:mb-8">
                        <div class="h-12 w-12 sm:h-16 sm:w-16 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg transform hover:scale-110 transition-all duration-300 flex-shrink-0">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 dark:text-gray-100 truncate">
                                Tambah Kategori Baru
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Silakan isi form di bawah ini untuk menambahkan kategori baru
                            </p>
                        </div>
                    </div>

                    <form method="POST" 
                          action="{{ route('admin.kategori.store') }}" 
                          enctype="multipart/form-data"
                          id="createForm" 
                          class="space-y-6">
                        @csrf
                        
                        <!-- Judul Kategori -->
                        <div class="relative group">
                            <label for="kategori_judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Judul Kategori <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="kategori_judul" 
                                       id="kategori_judul" 
                                       class="pl-10 sm:pl-12 pr-10 sm:pr-12 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500 transition-all duration-200 text-base"
                                       style="font-size: 16px;"
                                       value="{{ old('kategori_judul') }}"
                                       placeholder="Masukkan judul kategori"
                                       required>
                                <div class="hidden sm:flex absolute inset-y-0 right-0 pr-3 items-center pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity duration-200">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('kategori_judul')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sampul
                        <div class="relative group">
                            <label for="sampul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Upload Sampul (Opsional)
                            </label>
                            <div class="mt-1">
                                <input type="file" 
                                       name="sampul" 
                                       id="sampul" 
                                       accept="image/jpeg,image/png,image/jpg,image/svg+xml"
                                       class="block w-full text-sm text-gray-500 dark:text-gray-400
                                              file:mr-3 sm:file:mr-4 file:py-2.5 sm:file:py-2 file:px-4 sm:file:px-4
                                              file:rounded-lg sm:file:rounded-full file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-green-50 file:text-green-700
                                              hover:file:bg-green-100 active:file:bg-green-200
                                              dark:file:bg-green-900 dark:file:text-green-300
                                              cursor-pointer"
                                       onchange="previewImage(event)">
                            </div> -->
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <div class="relative inline-block w-full sm:w-auto">
                                    <img id="preview" 
                                         src="#" 
                                         alt="Preview" 
                                         class="rounded-lg shadow-lg w-full sm:max-w-md h-auto max-h-[250px] sm:max-h-[200px] object-contain">
                                    <button type="button" 
                                            onclick="handleRemoveImage(event)"
                                            class="absolute top-2 right-2 bg-red-500 text-white p-2.5 sm:p-2 rounded-full hover:bg-red-600 active:bg-red-700 transition-colors shadow-lg">
                                        <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- <p class="mt-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                Format yang didukung: JPG, JPEG, PNG, SVG. Maksimal 2MB.
                            </p> -->
                            @error('sampul')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700 mt-6">
                            <a href="{{ route('admin.kategori.index') }}" 
                               class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-3 sm:px-4 sm:py-2 bg-gray-500 hover:bg-gray-600 active:bg-gray-700 text-white rounded-lg transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2 sm:mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Batal
                            </a>
                            <button type="button"
                                    onclick="handleSubmit(event)"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-3 sm:px-4 sm:py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:from-green-600 hover:to-emerald-700 active:from-green-700 active:to-emerald-800 transition-all duration-200 transform active:scale-95 sm:hover:scale-105 shadow-lg hover:shadow-xl font-medium">
                                <svg class="w-5 h-5 mr-2 sm:mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Kategori
                            </button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            const input = document.getElementById('sampul');
            const preview = document.getElementById('imagePreview');
            input.value = '';
            preview.classList.add('hidden');
        }

        function handleSubmit(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: "Apakah Anda yakin ingin menyimpan kategori ini?",
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

        // Tampilkan SweetAlert untuk pesan sukses/error
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