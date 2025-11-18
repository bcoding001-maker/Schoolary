<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Events') }}
            </h2>
            <a href="{{ route('admin.events.create') }}" 
               class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg text-white text-sm font-semibold tracking-wide hover:from-cyan-600 hover:to-blue-700 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Event
            </a>
        </div>
    </x-slot>

    <!-- Flash Message -->
    @if(session('success'))
    <div class="flash-message" data-message="{{ session('success') }}"></div>
    @endif

    @if(session('error'))
    <div class="flash-error" data-message="{{ session('error') }}"></div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Upcoming Events -->
                <div class="col-span-2 sm:col-span-1 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl p-4 sm:p-6 shadow-xl transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-white text-sm font-medium uppercase tracking-wider">Upcoming Events</p>
                            <p class="text-white text-4xl font-bold mt-2 group-hover:scale-110 transition-transform duration-300">{{ $upcomingCount }}</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-3 transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Ongoing Events -->
                <div class="col-span-2 sm:col-span-1 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-4 sm:p-6 shadow-xl transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-white text-sm font-medium uppercase tracking-wider">Ongoing Events</p>
                            <p class="text-white text-4xl font-bold mt-2 group-hover:scale-110 transition-transform duration-300">{{ $ongoingCount }}</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-3 transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed Events -->
                <div class="col-span-2 sm:col-span-1 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-4 sm:p-6 shadow-xl transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-white text-sm font-medium uppercase tracking-wider">Completed Events</p>
                            <p class="text-white text-4xl font-bold mt-2 group-hover:scale-110 transition-transform duration-300">{{ $completedCount }}</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-full p-3 transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-4 sm:p-6">
                    <!-- Mobile & Tablet View (Card Layout) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4">
                        @foreach($events as $event)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <!-- Thumbnail -->
                            <div class="relative h-48">
                                @if($event->thumbnail)
                                    <img class="w-full h-full object-cover" 
                                         src="{{ asset('storage/events/' . $event->thumbnail) }}" 
                                         alt="{{ $event->event_name }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                    {{ $event->event_name }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2">
                                    {{ $event->description }}
                                </p>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300">{{ $event->location }}</span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-end space-x-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                                    <a href="{{ route('admin.events.edit', $event->event_id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 text-sm bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <button type="button"
                                            onclick="handleDelete({{ $event->event_id }})"
                                            class="inline-flex items-center px-3 py-1.5 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Desktop View (Table Layout) -->
                    <div class="hidden lg:block">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Event</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Lokasi</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Created By</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($events as $event)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($event->thumbnail)
                                                        <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                                                            <img src="{{ asset('storage/events/' . $event->thumbnail) }}" 
                                                                 alt="{{ $event->event_name }}"
                                                                 class="h-12 w-12 object-cover">
                                                        </div>
                                                    @else
                                                        <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            {{ $event->event_name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ Str::limit($event->description, 50) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                {{ $event->location }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                    {{ $event->status === 'upcoming' ? 'bg-blue-100 text-blue-800' : 
                                                       ($event->status === 'ongoing' ? 'bg-green-100 text-green-800' : 
                                                       'bg-purple-100 text-purple-800') }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                                                            {{ strtoupper(substr($event->user->name, 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                                            {{ $event->user->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('admin.events.edit', $event->event_id) }}" 
                                                   class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-all duration-200 transform hover:scale-105">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                
                                                <form action="{{ route('admin.events.destroy', $event->event_id) }}" 
                                                      method="POST" 
                                                      class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-all duration-200 transform hover:scale-105"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk delete confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tampilkan flash message jika ada
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessage = document.querySelector('.flash-message');
            const flashError = document.querySelector('.flash-error');
            
            if (flashMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: flashMessage.dataset.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    customClass: {
                        popup: 'colored-toast'
                    }
                });
            }

            if (flashError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: flashError.dataset.message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    customClass: {
                        popup: 'colored-toast'
                    }
                });
            }
        });

        function handleDelete(eventId) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus event ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    container: 'swal-mobile'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading state
                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Buat form untuk delete request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/events/${eventId}`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    
                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(method);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
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
    </style>

    <!-- Tambahkan style untuk toast notification -->
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }
        
        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }
        
        .colored-toast .swal2-title {
            color: white;
        }
        
        .colored-toast .swal2-close {
            color: white;
        }
        
        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
</x-app-layout> 