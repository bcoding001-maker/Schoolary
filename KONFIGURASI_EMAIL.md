# Konfigurasi Email untuk Fitur Hubungi Kami

## 📧 Fitur yang Sudah Dibuat

✅ Form kontak di halaman welcome
✅ Controller untuk mengirim email
✅ Template email yang profesional
✅ Validasi form
✅ Loading state & notifikasi sukses/error

## 🔧 Cara Konfigurasi Email

### Opsi 1: Menggunakan Gmail (Recommended untuk Testing)

1. Buka file `.env` di root project
2. Ubah konfigurasi email menjadi:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-anda@gmail.com
MAIL_PASSWORD=password-aplikasi-gmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email-anda@gmail.com
MAIL_FROM_NAME="SMK Negeri 4 Bogor"

# Email tujuan untuk menerima pesan kontak
MAIL_ADMIN_EMAIL=admin@smkn4bogor.sch.id
```

3. **Cara mendapatkan Password Aplikasi Gmail:**
   - Buka https://myaccount.google.com/security
   - Aktifkan "2-Step Verification"
   - Cari "App passwords"
   - Generate password untuk "Mail"
   - Copy password 16 digit dan paste ke `MAIL_PASSWORD`

### Opsi 2: Menggunakan Mailtrap (Recommended untuk Development)

1. Daftar di https://mailtrap.io (gratis)
2. Buat inbox baru
3. Copy kredensial SMTP
4. Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@smkn4bogor.sch.id
MAIL_FROM_NAME="SMK Negeri 4 Bogor"

MAIL_ADMIN_EMAIL=admin@smkn4bogor.sch.id
```

### Opsi 3: Menggunakan Log (Untuk Testing Tanpa Email Server)

Jika hanya ingin testing tanpa mengirim email sungguhan:

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@smkn4bogor.sch.id
MAIL_FROM_NAME="SMK Negeri 4 Bogor"
MAIL_ADMIN_EMAIL=admin@smkn4bogor.sch.id
```

Email akan tersimpan di `storage/logs/laravel.log`

## 📝 Cara Menggunakan

1. Buka website di browser
2. Scroll ke bagian "Hubungi Kami"
3. Isi form dengan:
   - Nama Lengkap
   - Email
   - Subjek
   - Pesan
4. Klik "Kirim Pesan"
5. Tunggu notifikasi sukses/error

## 🎨 Fitur Form Kontak

- ✅ Validasi real-time
- ✅ Loading state saat mengirim
- ✅ Notifikasi sukses (hijau)
- ✅ Notifikasi error (merah)
- ✅ Auto-reset form setelah sukses
- ✅ CSRF protection
- ✅ Responsive design

## 📧 Template Email

Email yang dikirim akan berisi:
- Nama pengirim
- Email pengirim (bisa langsung reply)
- Subjek
- Pesan lengkap
- Waktu diterima
- Design profesional dengan gradient Slate-Blue

## 🔒 Keamanan

- ✅ CSRF Token protection
- ✅ Email validation
- ✅ XSS protection
- ✅ Rate limiting (bisa ditambahkan)
- ✅ Input sanitization

## 🚀 Testing

1. Pastikan sudah konfigurasi email di `.env`
2. Jalankan: `php artisan config:clear`
3. Buka halaman welcome
4. Coba kirim pesan
5. Cek email di inbox (atau log jika pakai MAIL_MAILER=log)

## 📌 Catatan Penting

- Jangan commit file `.env` ke Git
- Gunakan App Password untuk Gmail, bukan password biasa
- Untuk production, gunakan email server yang reliable
- Tambahkan rate limiting untuk mencegah spam
- Pertimbangkan menggunakan queue untuk pengiriman email

## 🛠️ Troubleshooting

### Email tidak terkirim?
1. Cek konfigurasi di `.env`
2. Jalankan `php artisan config:clear`
3. Cek log di `storage/logs/laravel.log`
4. Pastikan firewall tidak block port 587/465

### Error "Connection refused"?
- Cek MAIL_HOST dan MAIL_PORT
- Pastikan internet connection aktif
- Coba gunakan Mailtrap untuk testing

### Email masuk spam?
- Gunakan email server yang proper
- Setup SPF, DKIM, DMARC records
- Gunakan domain email yang sama dengan website

## 📞 Support

Jika ada masalah, cek:
1. File log: `storage/logs/laravel.log`
2. Browser console untuk error JavaScript
3. Network tab untuk melihat request/response
