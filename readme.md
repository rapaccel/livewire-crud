# Livewire CRUD

Aplikasi CRUD sederhana menggunakan **Laravel** dan **Livewire** untuk mempermudah pengelolaan data secara real-time tanpa perlu menulis JavaScript.

## 🔧 Prasyarat

Pastikan Anda telah menginstal:

-   [PHP](https://www.php.net/) versi 8.0 atau lebih tinggi
-   [Composer](https://getcomposer.org/) untuk manajemen dependensi PHP
-   [Node.js](https://nodejs.org/) dan [npm](https://www.npmjs.com/) untuk manajemen dependensi frontend
-   Database (MySQL, MariaDB, atau lainnya)

## 🚀 Langkah-langkah Menjalankan Aplikasi

### 1. Clone repository

```bash
git clone https://github.com/rapaccel/livewire-crud.git
cd livewire-crud
```

### 2. Instal dependensi PHP

```bash
composer install
```

### 3. Salin file .env.example menjadi .env

```bash
cp .env.example .env
```

### 4. Generate key aplikasi

```bash
php artisan key:generate
```

### 5. Konfigurasi database

Buka file `.env` dan sesuaikan pengaturan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan migrasi database

```bash
php artisan migrate
```

### 7. Instal dependensi frontend

```bash
npm install
```

### 8. Bangun aset frontend

```bash
npm run dev
```

### 9. Jalankan server Laravel

```bash
php artisan serve
```

### 10. Akses aplikasi

Buka browser dan akses [http://localhost:8000](http://localhost:8000).

## 📝 Fitur

-   ✅ Create (Tambah data)
-   ✅ Read (Tampil data)
-   ✅ Update (Edit data)
-   ✅ Delete (Hapus data)
-   ⚡ Real-time updates dengan Livewire
-   🎨 Interface yang responsif

## 🛠️ Teknologi yang Digunakan

-   **Laravel** - Framework PHP
-   **Livewire** - Full-stack framework untuk Laravel
-   **Tailwind CSS** - Framework CSS utility-first
-   **Alpine.js** - Framework JavaScript yang ringan

## 📖 Dokumentasi

Untuk dokumentasi lengkap tentang Livewire, kunjungi [https://laravel-livewire.com](https://laravel-livewire.com).

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat pull request atau buka issue untuk saran dan perbaikan.

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
