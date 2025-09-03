# Aplikasi Manajemen Aplikasi Kabupaten Madiun

Sistem informasi untuk mengelola dan memantau aplikasi-aplikasi yang digunakan di lingkungan Pemerintah Kabupaten Madiun.

## 📋 Deskripsi

Aplikasi ini adalah sistem manajemen aplikasi berbasis web yang dirancang khusus untuk Pemerintah Kabupaten Madiun. Sistem ini memungkinkan admin untuk mengelola data aplikasi yang digunakan oleh berbagai OPD (Organisasi Perangkat Daerah) di lingkungan Kabupaten Madiun.

## 🚀 Fitur Utama

- **Dashboard Modern**: Tampilan beranda yang modern dengan statistik aplikasi real-time
- **Manajemen Aplikasi**: CRUD (Create, Read, Update, Delete) aplikasi dengan validasi lengkap
- **Manajemen OPD**: Pengelolaan data Organisasi Perangkat Daerah
- **Sistem Keamanan**: Akses admin-only untuk operasi sensitif (edit/hapus)
- **Autocomplete Search**: Pencarian OPD dengan fitur autocomplete
- **Responsive Design**: Tampilan yang optimal di desktop, tablet, dan mobile
- **Layout Full-Width**: Desain yang memenuhi layar desktop untuk pengalaman yang lebih baik

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12
- **Database**: MySQL 8.0.43
- **Frontend**: Blade Templates + Tailwind CSS
- **JavaScript**: Vanilla JS untuk interaktivitas
- **Server**: Apache/Nginx
- **PHP**: 8.3+

## 📊 Data

Aplikasi ini dilengkapi dengan:
- **58 OPD** (Organisasi Perangkat Daerah) Kabupaten Madiun
- **209+ Aplikasi** dengan data lengkap termasuk:
  - Nama aplikasi dan deskripsi detail
  - Status aplikasi (Aktif/Tidak Aktif)
  - Jenis aplikasi (Khusus/Daerah, Pusat/Umum, Lainnya)
  - Data pengelola dengan kontak WhatsApp
  - Domain/URL aplikasi

## 🔧 Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/Nakal-93/aplikasi_madiun.git
   cd aplikasi_madiun
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database**
   - Buat database MySQL: `aplikasi_madiun`
   - Update konfigurasi database di `.env`
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aplikasi_madiun
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

6. **Seed Data**
   ```bash
   php artisan db:seed --class=OpdSeeder
   php artisan db:seed --class=SampleAplikasiSeeder
   php artisan db:seed --class=AdminUserSeeder
   ```

7. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

## 👤 Login Admin

Untuk mengakses fitur admin (edit/hapus aplikasi):
- **Email**: admin@madiunkab.go.id
- **Password**: admin123

## 📱 Tampilan

### Dashboard Utama
- Statistik aplikasi per status dan jenis
- Grid aplikasi dengan design card yang modern
- Hero section dengan gradient background

### Detail Aplikasi
- Layout responsive 3-kolom
- Informasi lengkap aplikasi
- Data pengelola dan kontak

### Form Aplikasi
- Autocomplete untuk pencarian OPD
- Validasi input yang komprehensif
- Interface yang user-friendly

## 🔒 Keamanan

- Sistem autentikasi untuk admin
- Middleware keamanan untuk operasi CRUD
- Validasi input pada semua form
- Pembersihan data otomatis (nomor HP, domain)

## 📈 Statistik Aplikasi

- Total: 209+ aplikasi
- Status: 123 Aktif, 86 Tidak Aktif
- Jenis: 84 Khusus/Daerah, 71 Pusat/Umum, 54 Lainnya
- Distribusi: Tersebar di 58 OPD Kabupaten Madiun

## 🤝 Kontribusi

Proyek ini dikembangkan untuk Pemerintah Kabupaten Madiun. Untuk kontribusi atau pertanyaan, silakan hubungi tim pengembang.

## 📄 Lisensi

Aplikasi ini dikembangkan khusus untuk Pemerintah Kabupaten Madiun.

---

**Dikembangkan dengan ❤️ untuk Kabupaten Madiun**

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
