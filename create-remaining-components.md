# 🛠️ PANDUAN CEPAT: Membuat Component yang Tersisa

## 📝 INSTRUKSI COPY-PASTE

Ikuti langkah-langkah berikut untuk membuat 6 component yang tersisa:

---

## 1️⃣ GALERI COMPONENT

### Buat File:
```
resources/views/components/guest/galeri.blade.php
```

### Copy Baris:
Dari `welcome.blade.php` baris **599** sampai **724**

### Cari Text Awal:
```html
<!-- Galeri Section - Instagram Style -->
<section id="galeri"
```

### Cari Text Akhir:
```html
    </section>
        <!-- Berita & Agenda Section -->
```

**PENTING:** Jangan copy baris `<!-- Berita & Agenda Section -->`, hanya sampai `</section>` saja!

---

## 2️⃣ BERITA & AGENDA COMPONENT

### Buat File:
```
resources/views/components/guest/berita-agenda.blade.php
```

### Copy Baris:
Dari `welcome.blade.php` baris **725** sampai **849**

### Cari Text Awal:
```html
    <!-- Berita & Agenda Section -->
<section id="berita-agenda"
```

### Cari Text Akhir:
```html
    </section>

    <!-- Mitra Industri Section -->
```

**PENTING:** Jangan copy baris `<!-- Mitra Industri Section -->`, hanya sampai `</section>` saja!

---

## 3️⃣ MITRA INDUSTRI COMPONENT

### Buat File:
```
resources/views/components/guest/mitra-industri.blade.php
```

### Copy Baris:
Dari `welcome.blade.php` baris **851** sampai **947**

### Cari Text Awal:
```html
    <!-- Mitra Industri Section -->
<section id="mitra"
```

### Cari Text Akhir:
```html
            </div>

    <!-- Kontak Section -->
```

**PENTING:** Jangan copy baris `<!-- Kontak Section -->`, hanya sampai `</div>` terakhir dari section mitra!

---

## 4️⃣ KONTAK COMPONENT

### Buat File:
```
resources/views/components/guest/kontak.blade.php
```

### Copy Baris:
Dari `welcome.blade.php` baris **948** sampai **1044**

### Cari Text Awal:
```html
    <!-- Kontak Section -->
<section id="kontak"
```

### Cari Text Akhir:
```html
    </section>

    <!-- Footer -->
```

**PENTING:** Jangan copy baris `<!-- Footer -->`, hanya sampai `</section>` saja!

---

## 5️⃣ FOOTER COMPONENT

### Buat File:
```
resources/views/components/guest/footer.blade.php
```

### Copy Baris:
Dari `welcome.blade.php` baris **1045** sampai **1256**

### Cari Text Awal:
```html
    <!-- Footer -->
<footer class="relative overflow-hidden
```

### Cari Text Akhir:
```html
    </footer>

    <!-- Album View Modal -->
```

**PENTING:** Jangan copy baris `<!-- Album View Modal -->`, hanya sampai `</footer>` saja!

---

## 6️⃣ MODALS COMPONENT

### Buat File:
```
resources/views/components/guest/modals.blade.php
```

### Copy Baris:
Dari `welcome.blade.php` baris **1257** sampai **1900**

### Cari Text Awal:
```html
    <!-- Album View Modal -->
<div id="albumViewModal"
```

### Cari Text Akhir:
```html
    </div>
    <!-- End Photo View Modal -->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
```

**PENTING:** Jangan copy baris `<script src=`, hanya sampai `<!-- End Photo View Modal -->` dan `</div>` terakhir!

---

## 7️⃣ SCRIPTS COMPONENT

### Buat File:
```
resources/views/components/guest/scripts.blade.php
```

### Copy Baris:
Dari `welcome.blade.php` baris **1901** sampai **2353** (sampai akhir file)

### Cari Text Awal:
```html
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
```

### Cari Text Akhir:
```html
    </script>
</body>
</html>
```

**PENTING:** Jangan copy `</body>` dan `</html>`, hanya sampai `</script>` terakhir saja!

---

## ✅ CHECKLIST

Setelah membuat semua component, pastikan:

- [ ] **galeri.blade.php** - Ada file di `resources/views/components/guest/`
- [ ] **berita-agenda.blade.php** - Ada file di `resources/views/components/guest/`
- [ ] **mitra-industri.blade.php** - Ada file di `resources/views/components/guest/`
- [ ] **kontak.blade.php** - Ada file di `resources/views/components/guest/`
- [ ] **footer.blade.php** - Ada file di `resources/views/components/guest/`
- [ ] **modals.blade.php** - Ada file di `resources/views/components/guest/`
- [ ] **scripts.blade.php** - Ada file di `resources/views/components/guest/`

---

## 🎯 LANGKAH SELANJUTNYA

Setelah semua component dibuat:

1. **Backup file original:**
   ```bash
   cp resources/views/welcome.blade.php resources/views/welcome.blade.php.backup
   ```

2. **Ganti isi welcome.blade.php** dengan template dari `welcome-refactored-example.blade.php`

3. **Clear cache:**
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

4. **Test website:**
   - Buka di browser
   - Test semua fungsi
   - Pastikan tidak ada error

---

## 💡 TIPS COPY-PASTE

1. **Gunakan Ctrl+F** untuk cari text awal dan akhir
2. **Select dengan hati-hati** - pastikan tidak ada yang ketinggalan
3. **Paste langsung** ke file baru
4. **Save** dengan encoding UTF-8
5. **Cek indentasi** - pastikan rapi

---

## ⚠️ JIKA ADA ERROR

Jika ada error setelah copy-paste:

1. **Cek tag HTML** - pastikan `<section>` ada `</section>`
2. **Cek Blade syntax** - pastikan `@foreach` ada `@endforeach`
3. **Cek Alpine.js** - pastikan `x-data` tidak rusak
4. **Cek quote** - pastikan `"` dan `'` tidak hilang
5. **Cek bracket** - pastikan `{` ada `}`

---

**Selamat mengerjakan! Jika ada masalah, cek file COMPONENT_STATUS.md untuk detail lebih lanjut.** 🎉
