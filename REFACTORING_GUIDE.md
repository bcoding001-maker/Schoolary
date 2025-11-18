# 📚 PANDUAN REFACTORING WELCOME.BLADE.PHP

## 🎯 Tujuan
Memecah file `welcome.blade.php` yang panjang (2500+ baris) menjadi komponen-komponen kecil yang mudah di-maintain.

## 📁 Struktur Folder yang Direkomendasikan

```
resources/views/
├── welcome.blade.php (FILE UTAMA - hanya berisi include)
├── components/
│   └── guest/
│       ├── styles.blade.php ✅ SUDAH DIBUAT
│       ├── navigation.blade.php ✅ SUDAH DIBUAT
│       ├── hero.blade.php (PERLU DIBUAT)
│       ├── kejuruan.blade.php (PERLU DIBUAT)
│       ├── galeri.blade.php (PERLU DIBUAT)
│       ├── berita-agenda.blade.php (PERLU DIBUAT)
│       ├── mitra-industri.blade.php (PERLU DIBUAT)
│       ├── kontak.blade.php (PERLU DIBUAT)
│       ├── footer.blade.php (PERLU DIBUAT)
│       ├── modals.blade.php (PERLU DIBUAT)
│       └── scripts.blade.php (PERLU DIBUAT)
```

## ✅ Yang Sudah Dibuat

### 1. **styles.blade.php**
**Lokasi:** `resources/views/components/guest/styles.blade.php`

**Isi:**
- Semua CSS custom (glass-nav, glass-card, animations, dll)
- Keyframes animations
- Responsive styles
- Custom scrollbar
- Instagram-style effects

**Cara Pakai:**
```blade
@include('components.guest.styles')
```

---

### 2. **navigation.blade.php**
**Lokasi:** `resources/views/components/guest/navigation.blade.php`

**Isi:**
- Navigation bar (fixed top)
- Logo sekolah
- Desktop menu links
- Mobile hamburger menu
- Mobile dropdown menu
- Login/Dashboard links (jika ada)

**Cara Pakai:**
```blade
@include('components.guest.navigation')
```

---

## 📝 Komponen yang Perlu Dibuat

### 3. **hero.blade.php**
**Isi:**
- Hero section dengan slider
- Alpine.js untuk slider logic
- Previous/Next buttons
- Dot indicators
- Hero content (title, subtitle, CTA buttons)

**Baris di welcome.blade.php:** 391-483

---

### 4. **kejuruan.blade.php**
**Isi:**
- Section heading "Kejuruan"
- Grid cards untuk setiap jurusan (PPLG, DKV, TJKT, TO)
- Gradient border effects
- Hover animations

**Baris di welcome.blade.php:** 484-598

---

### 5. **galeri.blade.php**
**Isi:**
- Section heading "Galeri Sekolah"
- Search bar
- Category tabs (Semua, Akademik, Ekstrakurikuler, dll)
- Album cards grid
- Empty state

**Baris di welcome.blade.php:** 599-724

---

### 6. **berita-agenda.blade.php**
**Isi:**
- Section heading "Berita & Agenda"
- 2 kolom: Berita Terbaru & Agenda Mendatang
- Cards untuk berita
- Cards untuk agenda
- Empty states

**Baris di welcome.blade.php:** 725-850

---

### 7. **mitra-industri.blade.php**
**Isi:**
- Section heading "Mitra Industri"
- Grid untuk partner categories
- IT & Software Partners
- Manufacturing & Engineering Partners
- Logo perusahaan

**Baris di welcome.blade.php:** 851-947

---

### 8. **kontak.blade.php**
**Isi:**
- Section heading "Hubungi Kami"
- Contact form
- Contact information (alamat, telepon, email)
- Google Maps embed
- Social media links

**Baris di welcome.blade.php:** 948-1044

---

### 9. **footer.blade.php**
**Isi:**
- Footer dengan gradient background
- 4 kolom: Tentang Sekolah, Quick Links, Kontak, Social Media
- Copyright
- Scroll to top button

**Baris di welcome.blade.php:** 1045-1256

---

### 10. **modals.blade.php**
**Isi:**
- Album View Modal (untuk melihat foto dalam album)
- Photo View Modal (untuk melihat detail foto)
- Modal overlays
- Close buttons
- Instagram-style photo cards

**Baris di welcome.blade.php:** 1257-1900

---

### 11. **scripts.blade.php**
**Isi:**
- AOS initialization
- Navigation scroll detection
- Smooth scroll
- Gallery category switching
- Search functionality
- Modal functions (openAlbumView, closeAlbumView, dll)
- Like/Unlike functions
- View counter

**Baris di welcome.blade.php:** 1901-2353

---

## 🔧 Cara Implementasi

### Step 1: Buat File welcome.blade.php Baru (Simplified)

```blade
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
```

### Step 2: Passing Data ke Components

Jika component membutuhkan data dari controller, pass sebagai parameter:

```blade
@include('components.guest.galeri', [
    'allAlbums' => $allAlbums,
    'kategoris' => $kategoris
])
```

---

## ✅ Keuntungan Refactoring

1. **Mudah di-maintain** - Setiap section terpisah
2. **Reusable** - Component bisa dipakai di halaman lain
3. **Organized** - Code lebih terstruktur
4. **Debugging lebih mudah** - Tahu persis dimana masalahnya
5. **Team collaboration** - Bisa kerja parallel di component berbeda
6. **File lebih kecil** - Tidak perlu scroll 2500+ baris

---

## 🚀 Next Steps

1. ✅ **styles.blade.php** - SUDAH DIBUAT
2. ✅ **navigation.blade.php** - SUDAH DIBUAT
3. ⏳ Buat **hero.blade.php**
4. ⏳ Buat **kejuruan.blade.php**
5. ⏳ Buat **galeri.blade.php**
6. ⏳ Buat **berita-agenda.blade.php**
7. ⏳ Buat **mitra-industri.blade.php**
8. ⏳ Buat **kontak.blade.php**
9. ⏳ Buat **footer.blade.php**
10. ⏳ Buat **modals.blade.php**
11. ⏳ Buat **scripts.blade.php**
12. ⏳ Update **welcome.blade.php** untuk include semua components
13. ⏳ Test semua fungsi masih berjalan

---

## ⚠️ PENTING!

**JANGAN HAPUS FILE WELCOME.BLADE.PHP ORIGINAL!**

Backup dulu sebelum refactoring:
```bash
cp resources/views/welcome.blade.php resources/views/welcome.blade.php.backup
```

---

## 📞 Support

Jika ada masalah saat refactoring, cek:
1. Apakah semua variable di-pass dengan benar?
2. Apakah path include sudah benar?
3. Apakah Alpine.js masih berfungsi?
4. Apakah CSS masih ter-load?
5. Apakah JavaScript masih berjalan?

---

**Happy Refactoring! 🎉**
