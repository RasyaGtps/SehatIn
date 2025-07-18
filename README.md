
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# SehatIn

SehatIn adalah platform kesehatan digital yang bertujuan untuk memudahkan akses layanan kesehatan dan edukasi kesehatan mental bagi masyarakat Indonesia.

## 🌟 Fitur Utama

- **Konsultasi Online**: Layanan konsultasi dengan profesional kesehatan mental
- **Artikel Edukasi**: Informasi dan artikel terkait kesehatan mental
- **Panel Admin**: Manajemen konten dan pengguna
- **Autentikasi**: Sistem login dengan email atau Google

## 🛠️ Teknologi yang Digunakan

- Laravel 10.x
- PHP 8.1+
- MySQL
- Tailwind CSS
- JavaScript
- Vite

## 📋 Prasyarat

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## 🚀 Instalasi

1. Clone repositori
```bash
git clone https://github.com/RasyaGtps/SehatIn.git
cd SehatIn
```

2. Install dependensi PHP
```bash
composer install
```

3. Install dependensi JavaScript
```bash
npm install
```

4. Salin file environment
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Konfigurasi database di file `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sehatin
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database
```bash
php artisan migrate
```

8. Jalankan seeder (opsional)
```bash
php artisan db:seed
```

9. Compile assets
```bash
npm run dev
```

10. Jalankan server
```bash
php artisan serve
```

## 📱 Penggunaan

1. Buka browser dan akses `http://127.0.0.1:8000`
2. Register akun baru atau login dengan akun yang sudah ada
3. Untuk akses admin panel:
   - Login dengan akun admin
   - Akses `http://127.0.0.1:8000/admin/dashboard`

## 👥 Tim Pengembang

- Developer Team SMK Telkom Sidoarjo

## 📞 Kontak

- Telepon: +62 1234 5678
- Alamat: SMK TELKOM SIDOARJO, Indonesia

## 📄 Lisensi

Hak Cipta © 2025 SehatIn. Seluruh hak cipta dilindungi undang-undang.
