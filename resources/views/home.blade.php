@php
    $isGuest = Auth::guest();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Kota Bogor - Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen">
    <!-- Header -->
    <header class="shadow bg-white sticky top-0 z-50">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <div class="flex items-center gap-3">
                <img src="/build/assets/logo.png" alt="Logo SMKN 4 Kota Bogor" class="h-10 w-10 object-contain rounded-full border border-gray-200">
                <span class="text-2xl font-bold text-gray-800 tracking-wide">SMKN 4 Kota Bogor</span>
            </div>
            <nav class="flex gap-8 text-lg font-medium">
                <a href="/" class="text-gray-700 hover:text-blue-600 transition">Home</a>
                <a href="/about" class="text-gray-700 hover:text-blue-600 transition">About</a>
                <a href="/gallery" class="text-gray-700 hover:text-blue-600 transition">Gallery</a>
                <a href="/contact" class="text-gray-700 hover:text-blue-600 transition">Contact Us</a>
                @if($isGuest)
                    <a href="/login" class="ml-4 px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">Login</a>
                @else
                    <a href="/dashboard" class="ml-4 px-5 py-2 bg-gray-100 text-blue-700 rounded-lg shadow hover:bg-blue-100 transition">Dashboard</a>
                @endif
            </nav>
        </div>
    </header>
    <!-- Main Content -->
    <main class="container mx-auto py-12 px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Selamat Datang di Galeri SMKN 4 Kota Bogor</h1>
            <p class="text-lg text-gray-500">Temukan momen terbaik, kegiatan, dan prestasi sekolah kami di sini.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Contoh foto gallery statis -->
            <div class="rounded-xl overflow-hidden shadow-lg bg-white">
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=600&q=80" alt="Graduation" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800 mb-1">Wisuda Angkatan 2023</h3>
                    <p class="text-gray-500 text-sm">15 Juni 2023</p>
                </div>
            </div>
            <div class="rounded-xl overflow-hidden shadow-lg bg-white">
                <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=600&q=80" alt="Science Fair" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800 mb-1">Pameran Sains Tahunan</h3>
                    <p class="text-gray-500 text-sm">2 Mei 2023</p>
                </div>
            </div>
            <div class="rounded-xl overflow-hidden shadow-lg bg-white">
                <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?auto=format&fit=crop&w=600&q=80" alt="Basketball" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800 mb-1">Turnamen Basket Antar Kelas</h3>
                    <p class="text-gray-500 text-sm">20 April 2023</p>
                </div>
            </div>
        </div>
        <div class="mt-16 text-center">
            <a href="/gallery" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition text-lg font-semibold">Lihat Semua Gallery</a>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-gray-100 py-6 mt-16">
        <div class="container mx-auto text-center text-gray-500">
            &copy; 2025 SMKN 4 Kota Bogor. All rights reserved.
        </div>
    </footer>
</body>
</html>