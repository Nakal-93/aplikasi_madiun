# 🏛️ Aplikasi Data Aplikasi Kabupaten Madiun

[![Production Ready](https://img.shields.io/badge/Production-Ready-green.svg)](https://github.com/Nakal-93/aplikasi_madiun)
[![Laravel](https://img.shields.io/badge/Laravel-12.26.4-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://docker.com)
[![Kubernetes](https://img.shields.io/badge/Kubernetes-Ready-blue.svg)](https://kubernetes.io)

> **Sistem Informasi Manajemen Aplikasi Pemerintah Kabupaten Madiun**  
> Platform terpusat untuk mengelola, memantau, dan mendata seluruh aplikasi yang digunakan di lingkungan Pemerintah Kabupaten Madiun.

## 📋 Tentang Aplikasi

Aplikasi Data Aplikasi Kabupaten Madiun adalah sistem manajemen aplikasi berbasis web yang dirancang khusus untuk Pemerintah Kabupaten Madiun. Sistem ini memungkinkan admin untuk mengelola data aplikasi yang digunakan oleh berbagai OPD (Organisasi Perangkat Daerah) dengan fitur lengkap dan interface yang modern.

## 🚀 Fitur Utama

### 💼 Manajemen Data
- **Dashboard Modern**: Tampilan beranda dengan statistik real-time dan visualisasi data
- **Manajemen Aplikasi**: CRUD lengkap dengan validasi komprehensif
- **Manajemen OPD**: Pengelolaan data 61 Organisasi Perangkat Daerah
- **Import/Export Data**: Bulk import dari CSV dengan mapping otomatis OPD

### 🔍 Pencarian & Filter
- **Autocomplete Search**: Pencarian OPD dengan fitur autocomplete cerdas
- **Filter Multi-Level**: Filter berdasarkan status, jenis, dan OPD
- **Search Global**: Pencarian across semua field dengan highlighting

### 📱 User Experience
- **Responsive Design**: Optimized untuk desktop, tablet, dan mobile
- **Mobile-First UI**: Interface khusus dioptimasi untuk perangkat mobile
- **Progressive Web App**: Fast loading dengan offline capability
- **Accessibility**: WCAG 2.1 compliant untuk inklusivitas

### 🔒 Keamanan & Performance
- **Role-Based Access**: Sistem keamanan berlapis dengan role admin
- **Data Validation**: Input sanitization dan validation rules
- **Production Optimized**: Caching, compression, dan performance tuning
- **Backup System**: Automated backup dengan restore capabilities

### 🚀 Deployment Options
- **Traditional Server**: Script instalasi otomatis dengan SSL
- **Docker**: Multi-stage containerization untuk development dan production
- **Kubernetes**: Production-ready dengan auto-scaling dan monitoring
- **CI/CD Ready**: GitHub Actions integration untuk automated deployment

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 12.26.4
- **PHP**: 8.2+ dengan OPcache
- **Database**: MySQL 8.0+ dengan optimization
- **Cache**: Redis untuk session dan application cache
- **Queue**: Redis-backed job processing

### Frontend
- **Template Engine**: Blade Templates
- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Vanilla ES6+ dengan module bundling
- **Icons**: Heroicons dan custom SVG
- **Fonts**: Inter untuk optimal readability

### Infrastructure
- **Web Server**: Nginx/Apache dengan HTTP/2
- **Process Manager**: Supervisor untuk background jobs
- **Monitoring**: Prometheus + Grafana stack
- **Container**: Docker dengan multi-stage builds
- **Orchestration**: Kubernetes dengan Helm charts

### Development Tools
- **Version Control**: Git dengan conventional commits
- **Package Manager**: Composer + NPM
- **Build Tools**: Vite untuk asset compilation
- **Testing**: PHPUnit + Laravel Dusk
- **Code Quality**: PHP CS Fixer + ESLint

## 📊 Data & Statistics

### Current Data (Per September 2025)
- **Total Aplikasi**: 218 applications
  - Import data: 185 applications (berhasil diimport dari CSV)
  - Data existing: 33 applications (data awal)
- **Total OPD**: 61 Organisasi Perangkat Daerah
- **Status Distribution**:
  - ✅ Aktif: 150+ aplikasi
  - ⏸️ Tidak Aktif: 60+ aplikasi
- **Jenis Distribution**:
  - 🏛️ Khusus/Daerah: 90+ aplikasi
  - 🌐 Pusat/Umum: 80+ aplikasi  
  - 📱 Lainnya: 40+ aplikasi

### Data Quality Features
- **Normalisasi URL**: Auto-prefix https:// untuk domain
- **Multi-link Support**: Pisahkan multiple URLs otomatis
- **Contact Validation**: Format nomor WhatsApp dan email
- **Duplicate Prevention**: Cek duplikasi berdasarkan nama dan OPD
- **Data Migration**: Backup dan restore dengan validation

## � Quick Start

### 🔥 Instalasi Otomatis (Recommended)
```bash
# Download dan jalankan script instalasi
wget https://raw.githubusercontent.com/Nakal-93/aplikasi_madiun/main/install.sh
chmod +x install.sh
./install.sh
```

### 🐳 Docker Development
```bash
# Clone repository
git clone https://github.com/Nakal-93/aplikasi_madiun.git
cd aplikasi_madiun

# Start development environment
./docker-build.sh all development

# Access:
# - App: http://localhost:8000
# - phpMyAdmin: http://localhost:8080
# - MailHog: http://localhost:8025
```

### ☸️ Kubernetes Production
```bash
# Deploy to production cluster
./deploy-k8s.sh production deploy

# Access aplikasi via configured ingress
# SSL automatic dengan Let's Encrypt
```

## 📖 Detailed Installation

### Prerequisites
- **PHP 8.2+** dengan extensions: mbstring, zip, xml, pdo_mysql, gd, redis
- **MySQL 8.0+** atau MariaDB 10.6+
- **Redis 6.0+** untuk caching dan sessions
- **Node.js 18+** untuk asset compilation
- **Composer 2.0+** untuk dependency management

### Manual Installation

1. **Clone Repository**
   ```bash
   git clone https://github.com/Nakal-93/aplikasi_madiun.git
   cd aplikasi_madiun
   ```

2. **Install Dependencies**
   ```bash
   composer install --optimize-autoloader
   npm install && npm run build
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aplikasi_madiun
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   
   REDIS_HOST=127.0.0.1
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   ```

5. **Database Migration & Seeding**
   ```bash
   php artisan migrate
   php artisan db:seed --class=OpdSeeder
   php artisan db:seed --class=AdminUserSeeder
   
   # Optional: Import sample data
   php artisan db:seed --class=AplikasiImportSeeder
   ```

6. **Storage & Permissions**
   ```bash
   php artisan storage:link
   chmod -R 775 storage bootstrap/cache
   ```

7. **Production Optimization** (if needed)
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   # Access: http://localhost:8000
   ```

## 👤 Default Credentials

### Admin Access
- **Email**: `admin@madiunkab.go.id`
- **Password**: `admin123`
- **Role**: Super Admin (full CRUD access)

> ⚠️ **Production Security**: Pastikan untuk mengubah credentials default pada deployment production!

## 📱 Screenshots & Features

### 🏠 Dashboard Overview
- **Real-time Statistics**: Total aplikasi, distribusi status, dan jenis
- **Interactive Charts**: Visualisasi data dengan Chart.js
- **Quick Actions**: Shortcut untuk operasi umum
- **Recent Activities**: Log aktivitas terbaru

### 📋 Application Management
- **Data Grid**: Tabel responsif dengan sorting dan pagination
- **Advanced Filters**: Filter multi-kriteria dengan real-time search
- **Bulk Operations**: Import/export CSV, bulk edit status
- **Detail View**: Modal/page detail dengan informasi lengkap

### 📝 Form Features
- **Smart Autocomplete**: Pencarian OPD dengan fuzzy matching
- **Real-time Validation**: Instant feedback untuk input validation
- **Rich Text Editor**: WYSIWYG editor untuk deskripsi panjang
- **File Upload**: Upload logo/gambar aplikasi dengan preview

### 📱 Mobile Experience
- **Touch-Optimized**: Interface didesain khusus untuk touch devices
- **Responsive Navigation**: Collapsible sidebar dan mobile menu
- **Swipe Gestures**: Swipe untuk aksi cepat pada mobile
- **Offline Support**: Progressive Web App dengan offline capability

## 🔒 Security Features

### Authentication & Authorization
- **Secure Login**: Laravel Breeze dengan rate limiting
- **Role-Based Access Control**: Admin vs Guest permissions
- **Session Security**: Secure session handling dengan Redis
- **CSRF Protection**: Built-in Laravel CSRF tokens

### Data Protection
- **Input Validation**: Comprehensive validation rules
- **SQL Injection Prevention**: Eloquent ORM protection
- **XSS Prevention**: Blade template auto-escaping
- **Data Sanitization**: Clean input pada form handling

### Infrastructure Security
- **HTTPS Enforcement**: SSL/TLS certificates dengan auto-renewal
- **Security Headers**: HSTS, CSP, X-Frame-Options, dll
- **Rate Limiting**: API dan login rate limiting
- **Error Handling**: Secure error pages without information leakage

## 🚀 Deployment Options

### 📦 Production Deployment Guides
- **[Installation Guide](INSTALLATION_GUIDE.md)**: Panduan lengkap instalasi traditional server
- **[Quick Deploy](QUICK_DEPLOY.md)**: Script instalasi otomatis dengan SSL
- **[Container Guide](CONTAINER_GUIDE.md)**: Docker dan Kubernetes deployment

### � Containerization
```bash
# Development
./docker-build.sh all development

# Production dengan monitoring
./docker-build.sh all stack

# Kubernetes production
./deploy-k8s.sh production deploy
```

### 📊 Monitoring & Observability
- **Application Metrics**: Response time, request rate, error tracking
- **Infrastructure Monitoring**: CPU, memory, disk, network usage
- **Database Performance**: Query analysis dan optimization
- **Log Aggregation**: Centralized logging dengan ELK stack integration

## 📚 Documentation

### 📖 Complete Guides
- **[Production Readiness Check](PRODUCTION_READINESS_CHECK.md)**: Pre-deployment checklist
- **[Container Guide](CONTAINER_GUIDE.md)**: Docker dan Kubernetes setup
- **[Installation Guide](INSTALLATION_GUIDE.md)**: Step-by-step server setup
- **[Quick Deploy Guide](QUICK_DEPLOY.md)**: Automated deployment scripts

### 🔧 Technical Documentation
- **Database Schema**: ERD dan migration files
- **API Documentation**: Route list dan parameter specification
- **Architecture Decision Records**: Technical decisions dan rationale
- **Performance Benchmarks**: Load testing results dan optimization

## 🤝 Contributing

### Development Workflow
1. **Fork & Clone**: Fork repository dan clone ke local development
2. **Feature Branch**: Buat branch baru untuk setiap feature/bugfix
3. **Code Standards**: Ikuti PSR-12 untuk PHP dan conventional commits
4. **Testing**: Pastikan semua tests pass sebelum submit PR
5. **Documentation**: Update dokumentasi untuk changes yang significant

### Code Quality
- **PHP CS Fixer**: Automatic code formatting
- **PHPStan**: Static analysis untuk bug detection
- **Laravel Pint**: Laravel-specific code style fixer
- **Husky**: Pre-commit hooks untuk quality gates

### Testing Guidelines
```bash
# Run all tests
php artisan test

# Feature tests
php artisan test --testsuite=Feature

# Unit tests
php artisan test --testsuite=Unit

# Coverage report
php artisan test --coverage
```

## 📄 License

**Copyright © 2025 Pemerintah Kabupaten Madiun**

Aplikasi ini dikembangkan khusus untuk Pemerintah Kabupaten Madiun. Penggunaan, modifikasi, dan distribusi tunduk pada peraturan dan kebijakan internal Pemerintah Kabupaten Madiun.

### Third-Party Licenses
- **Laravel Framework**: MIT License
- **Tailwind CSS**: MIT License
- **Other Dependencies**: Lihat `composer.json` dan `package.json`

## � Support & Contact

### Technical Support
- **Repository Issues**: [GitHub Issues](https://github.com/Nakal-93/aplikasi_madiun/issues)
- **Documentation**: Lengkap tersedia di repository
- **Community**: Discussion via GitHub Discussions

### Official Contact
- **Pemerintah Kabupaten Madiun**
- **Dinas Komunikasi dan Informatika**
- **Email**: kominfo@madiunkab.go.id
- **Website**: https://madiunkab.go.id

---

## 🏆 Project Status

### ✅ Completed Features
- ✅ **Core CRUD Operations**: Full application management
- ✅ **OPD Management**: Complete organization data
- ✅ **Import/Export**: CSV bulk operations dengan mapping
- ✅ **Responsive Design**: Mobile-first UI optimization
- ✅ **Authentication**: Secure admin access
- ✅ **Production Ready**: Performance optimized
- ✅ **Container Support**: Docker dan Kubernetes ready
- ✅ **Documentation**: Comprehensive guides

### 🚀 Current Version: v1.0.0
- **Production Ready**: ✅ Deployed dan stable
- **Performance**: ✅ Optimized untuk high traffic
- **Security**: ✅ Security audit passed
- **Documentation**: ✅ Complete dan up-to-date

---

**🏛️ Dikembangkan dengan ❤️ untuk Kabupaten Madiun** 

> *"Digitalisasi Pelayanan Publik untuk Masyarakat yang Lebih Baik"*


