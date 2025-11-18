<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- ============================================
         CUSTOM STYLES - Semua CSS ada di sini
         ============================================ --}}
    @include('components.guest.styles')
</head>
<body class="antialiased min-h-screen bg-white">
    
    {{-- ============================================
         NAVIGATION - Fixed top navigation bar
         ============================================ --}}
    @include('components.guest.navigation')
    
    {{-- ============================================
         HERO SECTION - Slider dengan Alpine.js
         File: components/guest/hero.blade.php
         ============================================ --}}
    {{-- @include('components.guest.hero') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         KEJURUAN SECTION - Program keahlian cards
         File: components/guest/kejuruan.blade.php
         ============================================ --}}
    {{-- @include('components.guest.kejuruan') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         GALERI SECTION - Album & foto gallery
         File: components/guest/galeri.blade.php
         Data: $allAlbums, $kategoris
         ============================================ --}}
    {{-- @include('components.guest.galeri', [
        'allAlbums' => $allAlbums,
        'kategoris' => $kategoris
    ]) --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         BERITA & AGENDA SECTION
         File: components/guest/berita-agenda.blade.php
         ============================================ --}}
    {{-- @include('components.guest.berita-agenda') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         MITRA INDUSTRI SECTION
         File: components/guest/mitra-industri.blade.php
         ============================================ --}}
    {{-- @include('components.guest.mitra-industri') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         KONTAK SECTION - Form & info kontak
         File: components/guest/kontak.blade.php
         ============================================ --}}
    {{-- @include('components.guest.kontak') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         FOOTER - Footer dengan 4 kolom
         File: components/guest/footer.blade.php
         ============================================ --}}
    {{-- @include('components.guest.footer') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         MODALS - Album & Photo view modals
         File: components/guest/modals.blade.php
         ============================================ --}}
    {{-- @include('components.guest.modals') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
    {{-- ============================================
         SCRIPTS - JavaScript functions & AOS init
         File: components/guest/scripts.blade.php
         ============================================ --}}
    {{-- @include('components.guest.scripts') --}}
    {{-- CATATAN: Belum dibuat, masih di welcome.blade.php original --}}
    
</body>
</html>
