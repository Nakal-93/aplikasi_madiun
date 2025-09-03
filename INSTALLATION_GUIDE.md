# 🚀 Installation Guide - Aplikasi Data Aplikasi Kabupaten Madiun

> **Complete Server Installation Guide**  
> Panduan lengkap instalasi server traditional untuk deployment production-ready

[![Laravel](https://img.shields.io/badge/Laravel-12.26.4-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![Production](https://img.shields.io/badge/Production-Ready-green.svg)](https://github.com/Nakal-93/aplikasi_madiun)

## 📋 Prasyarat Server

### Kebutuhan Sistem:
- **OS**: Ubuntu 20.04+ / CentOS 8+ / Debian 10+
- **PHP**: 8.1 atau lebih tinggi
- **Database**: MySQL 8.0+ / MariaDB 10.4+
- **Web Server**: Nginx / Apache
- **Node.js**: 18+ (untuk build assets)
- **Composer**: 2.x
- **Git**: untuk clone repository

### Extensions PHP yang diperlukan:
```bash
php-fpm php-mysql php-mbstring php-xml php-curl php-zip php-gd php-intl php-bcmath
```

---

## 🔧 Langkah Instalasi

### 1. **Clone Repository**
```bash
# Clone ke direktori web server
cd /var/www/
sudo git clone https://github.com/Nakal-93/aplikasi_madiun.git
cd aplikasi_madiun

# Set ownership ke web server user
sudo chown -R www-data:www-data /var/www/aplikasi_madiun
sudo chmod -R 755 /var/www/aplikasi_madiun
```

### 2. **Install Dependencies**
```bash
# Install Composer dependencies
sudo -u www-data composer install --optimize-autoloader --no-dev

# Install Node.js dependencies
sudo -u www-data npm install

# Build production assets
sudo -u www-data npm run build
```

### 3. **Konfigurasi Environment**
```bash
# Copy dan edit file environment
sudo -u www-data cp .env.example .env
sudo -u www-data nano .env
```

**Edit file `.env` untuk production:**
```env
APP_NAME="Data Aplikasi Kabupaten Madiun"
APP_ENV=production
APP_KEY=base64:GENERATE_NEW_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

APP_LOCALE=id
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=id_ID

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aplikasi_madiun_prod
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

# Session & Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database

# Mail Configuration (opsional)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-server
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="admin@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. **Generate Application Key**
```bash
sudo -u www-data php artisan key:generate
```

### 5. **Setup Database**
```bash
# Login ke MySQL
mysql -u root -p

# Buat database dan user
CREATE DATABASE aplikasi_madiun_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'madiun_user'@'localhost' IDENTIFIED BY 'secure_password_here';
GRANT ALL PRIVILEGES ON aplikasi_madiun_prod.* TO 'madiun_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 6. **Jalankan Migrasi Database**
```bash
# Jalankan migrasi
sudo -u www-data php artisan migrate --force

# Seed data OPD (jika diperlukan)
sudo -u www-data php artisan db:seed --class=OpdSeeder --force
```

### 7. **Optimasi untuk Production**
```bash
# Cache konfigurasi, routes, dan views
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache

# Link storage untuk file uploads
sudo -u www-data php artisan storage:link

# Set permissions yang benar
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 8. **Konfigurasi Web Server**

#### **Nginx Configuration** (`/etc/nginx/sites-available/aplikasi-madiun`):
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/aplikasi_madiun/public;
    index index.php index.html;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Handle requests
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP handling
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    # Deny access to sensitive files
    location ~ /\.(env|git) {
        deny all;
    }

    # Static files caching
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

**Aktifkan site:**
```bash
sudo ln -s /etc/nginx/sites-available/aplikasi-madiun /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### **Apache Configuration** (alternatif):
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    DocumentRoot /var/www/aplikasi_madiun/public

    <Directory /var/www/aplikasi_madiun/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # Security
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-XSS-Protection "1; mode=block"

    ErrorLog ${APACHE_LOG_DIR}/aplikasi-madiun_error.log
    CustomLog ${APACHE_LOG_DIR}/aplikasi-madiun_access.log combined
</VirtualHost>
```

### 9. **Setup SSL dengan Let's Encrypt** (Opsional tapi Direkomendasikan)
```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Generate SSL certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

### 10. **Buat User Admin**
```bash
# Masuk ke tinker untuk buat user admin
sudo -u www-data php artisan tinker

# Di dalam tinker, jalankan:
```
```php
use App\Models\User;
User::create([
    'name' => 'Administrator',
    'email' => 'admin@yourdomain.com',
    'password' => bcrypt('your_secure_admin_password'),
    'email_verified_at' => now()
]);
exit;
```

### 11. **Setup Cron Jobs** (untuk maintenance)
```bash
sudo crontab -e

# Tambahkan baris ini:
* * * * * cd /var/www/aplikasi_madiun && php artisan schedule:run >> /dev/null 2>&1

# Backup harian (opsional)
0 2 * * * cd /var/www/aplikasi_madiun && php artisan backup:aplikasis
```

### 12. **Monitoring & Logs**
```bash
# Setup log rotation
sudo nano /etc/logrotate.d/aplikasi-madiun
```

**Isi file logrotate:**
```
/var/www/aplikasi_madiun/storage/logs/*.log {
    daily
    missingok
    rotate 30
    compress
    notifempty
    create 0644 www-data www-data
}
```

---

## 🔍 Verifikasi Instalasi

### Test aplikasi berjalan:
```bash
# Cek status aplikasi
sudo -u www-data php artisan about

# Test database connection
sudo -u www-data php artisan migrate:status

# Cek permissisons
ls -la storage/ bootstrap/cache/
```

### Test melalui browser:
1. Akses `https://yourdomain.com`
2. Klik "Login Admin"
3. Login dengan credential admin yang dibuat
4. Test CRUD aplikasi
5. Test import CSV (jika diperlukan)

---

## 🛠️ Troubleshooting

### Permission Issues:
```bash
# Reset permissions
sudo chown -R www-data:www-data /var/www/aplikasi_madiun
sudo chmod -R 755 /var/www/aplikasi_madiun
sudo chmod -R 775 storage bootstrap/cache
```

### Clear Cache jika ada masalah:
```bash
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan route:clear
sudo -u www-data php artisan view:clear
```

### Debug Mode (hanya untuk troubleshooting):
```bash
# Edit .env sementara
APP_DEBUG=true
APP_LOG_LEVEL=debug

# Jangan lupa ubah kembali ke false setelah selesai
```

---

## 📊 Import Data (Opsional)

Jika ingin mengimpor data CSV:
```bash
# Siapkan file mapping OPD
sudo -u www-data cp storage/app/import/mapping_opd_template.csv storage/app/import/mapping_opd.csv

# Edit mapping sesuai OPD di sistem
sudo -u www-data nano storage/app/import/mapping_opd.csv

# Jalankan import
sudo -u www-data php artisan db:seed --class=AplikasiImportSeeder
```

---

## 🔒 Security Checklist

- [ ] `APP_DEBUG=false` di production
- [ ] `APP_ENV=production`
- [ ] Database user memiliki privileges minimal
- [ ] SSL certificate terpasang
- [ ] Firewall dikonfigurasi (port 80, 443, 22)
- [ ] Regular backup database
- [ ] Update sistem secara berkala
- [ ] Monitor log error

---

## 📞 Support

Jika ada masalah saat instalasi:
1. Cek log error di `storage/logs/laravel.log`
2. Cek web server error log
3. Pastikan semua requirements terpenuhi
4. Verifikasi permissions dan ownership

**Repository:** https://github.com/Nakal-93/aplikasi_madiun
**Version:** Production Ready ✅
