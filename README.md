# KickStore - E-Commerce Application

KickStore adalah aplikasi e-commerce modern yang dibangun menggunakan Laravel 12, Filament PHP, dan Tailwind CSS. Aplikasi ini dirancang untuk memberikan pengalaman berbelanja sepatu yang mulus bagi pengguna dan manajemen toko yang efisien bagi administrator.

## 🚀 Fitur Utama

### 🛒 Sisi Pelanggan (Public & User)
- **Katalog Produk**: Telusuri berbagai produk sepatu dengan kategori yang berbeda.
- **Detail Produk**: Lihat informasi mendalam tentang setiap produk.
- **Sistem Keranjang**: Tambahkan, perbarui, dan hapus item dari keranjang belanja secara real-time.
- **Checkout**: Proses pemesanan yang mudah dengan integrasi pembayaran/konfirmasi manual via Bank.
- **Manajemen Profil**: Pelanggan dapat mengelola informasi akun mereka sendiri.
- **Riwayat Pesanan**: Pantau status pesanan yang telah dilakukan.

### 🛠️ Sisi Administrator (Dashboard Admin)
*Ditenagai oleh Filament PHP, memberikan antarmuka manajemen yang powerful:*
- **Dashboard**: Ringkasan singkat performa toko.
- **Manajemen Produk & Kategori**: Kelola inventaris barang dengan mudah.
- **Manajemen Pesanan**: Lihat dan perbarui status pesanan pelanggan.
- **Konfigurasi Bank**: Kelola destinasi pembayaran transfer bank.
- **Manajemen Pengguna**: Kelola akun pelanggan dan admin lainnya.

---

## 💻 Persyaratan Sistem
- **PHP**: v8.2 atau lebih baru
- **Composer**: v2.x
- **Node.js & NPM**: v18.x atau lebih baru
- **Database**: MySQL / MariaDB
- **Web Server**: Apache / Nginx / Artisan Serve

---

## 🛠️ Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan KickStore di lingkungan lokal Anda:

### 1. Persiapan Awal
Pastikan Anda sudah berada di dalam folder proyek:
```bash
# Jika menggunakan Git
git clone https://github.com/username/kickstore.git
cd kickstore
```

### 2. Instalasi Dependensi
Jalankan perintah berikut untuk menginstal paket PHP dan JavaScript:
```bash
composer install
npm install
```

### 3. Konfigurasi Lingkungan (.env)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Lalu, buatlah database baru di MySQL (misal bernama `kickstore`) dan sesuaikan pengaturan database di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kickstore
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key
```bash
php artisan key:generate
```

### 5. Migrasi dan Seeding Database
Jalankan perintah ini untuk membuat tabel dan mengisi data awal (termasuk akun Admin):
```bash
php artisan migrate --seed
```

### 6. Menjalankan Aplikasi
Buka dua terminal dan jalankan perintah berikut:

**Terminal 1 (Backend):**
```bash
php artisan serve
```

**Terminal 2 (Frontend Assets):**
```bash
npm run dev
```

Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

---

## 👤 Akun Default Admin
Untuk mengakses panel admin di `http://127.0.0.1:8000/admin`, gunakan kredensial berikut:

- **Email**: `admin@gmail.com`
- **Password**: `123`

---

## 📝 Lisensi
Proyek ini bersifat open-source dan dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
