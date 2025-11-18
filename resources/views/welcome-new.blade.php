<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Custom Styles --}}
    @include('components.guest.styles')
</head>
<body class="antialiased min-h-screen bg-white">
    
    {{-- Navigation --}}
    @include('components.guest.navigation')
    
    {{-- Hero Section --}}
    @include('components.guest.hero')
    
    {{-- Kejuruan Section --}}
    @include('components.guest.kejuruan')
    
    {{-- Galeri Section --}}
    @include('components.guest.galeri', [
        'allAlbums' => $allAlbums,
        'kategoris' => $kategoris
    ])
    
    {{-- Berita & Agenda Section --}}
    @include('components.guest.berita-agenda')
    
    {{-- Mitra Industri Section --}}
    @include('components.guest.mitra-industri')
    
    {{-- Kontak Section --}}
    @include('components.guest.kontak')
    
    {{-- Footer --}}
    @include('components.guest.footer')
    
    {{-- Modals --}}
    @include('components.guest.modals')
    
    {{-- Scripts --}}
    @include('components.guest.scripts')
    
</body>
</html>
