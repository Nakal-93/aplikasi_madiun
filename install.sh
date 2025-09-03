#!/bin/bash

# 🚀 Auto Installation Script untuk Aplikasi Data Aplikasi Kabupaten Madiun
# Jalankan dengan: bash install.sh

set -e  # Exit jika ada error

echo "=================================================="
echo "🚀 INSTALASI APLIKASI DATA APLIKASI KABUPATEN MADIUN"
echo "=================================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function untuk print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

print_step() {
    echo -e "${BLUE}[STEP]${NC} $1"
}

# Check if running as root
if [[ $EUID -eq 0 ]]; then
    print_warning "Script ini sebaiknya tidak dijalankan sebagai root"
    read -p "Lanjutkan? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi

# Get input dari user
print_step "Mengumpulkan informasi konfigurasi..."
read -p "Domain aplikasi (contoh: apps.madiunkab.go.id): " DOMAIN
read -p "Database name [aplikasi_madiun]: " DB_NAME
DB_NAME=${DB_NAME:-aplikasi_madiun}
read -p "Database username [madiun_user]: " DB_USER
DB_USER=${DB_USER:-madiun_user}
read -s -p "Database password: " DB_PASS
echo
read -p "Email admin: " ADMIN_EMAIL
read -s -p "Password admin: " ADMIN_PASS
echo
read -p "Install SSL dengan Let's Encrypt? (y/N): " SSL_INSTALL

# Detect web server
if systemctl is-active --quiet nginx; then
    WEBSERVER="nginx"
elif systemctl is-active --quiet apache2; then
    WEBSERVER="apache"
else
    print_error "Web server (nginx/apache) tidak terdeteksi!"
    exit 1
fi

print_status "Web server terdeteksi: $WEBSERVER"

# 1. Clone repository
print_step "1. Clone repository..."
if [ ! -d "/var/www/aplikasi_madiun" ]; then
    cd /var/www/
    sudo git clone https://github.com/Nakal-93/aplikasi_madiun.git
    print_status "Repository berhasil di-clone"
else
    print_warning "Directory /var/www/aplikasi_madiun sudah ada"
fi

cd /var/www/aplikasi_madiun

# 2. Set permissions
print_step "2. Set permissions..."
sudo chown -R www-data:www-data /var/www/aplikasi_madiun
sudo chmod -R 755 /var/www/aplikasi_madiun
sudo chmod -R 775 storage bootstrap/cache

# 3. Install dependencies
print_step "3. Install Composer dependencies..."
sudo -u www-data composer install --optimize-autoloader --no-dev --no-interaction

print_step "4. Install Node.js dependencies..."
sudo -u www-data npm install --silent

print_step "5. Build production assets..."
sudo -u www-data npm run build

# 4. Setup environment
print_step "6. Setup environment file..."
sudo -u www-data cp .env.example .env

# Generate app key
print_step "7. Generate application key..."
sudo -u www-data php artisan key:generate --force

# Configure .env
print_step "8. Configure environment variables..."
sudo -u www-data sed -i "s|APP_ENV=.*|APP_ENV=production|" .env
sudo -u www-data sed -i "s|APP_DEBUG=.*|APP_DEBUG=false|" .env
sudo -u www-data sed -i "s|APP_URL=.*|APP_URL=https://$DOMAIN|" .env
sudo -u www-data sed -i "s|DB_DATABASE=.*|DB_DATABASE=$DB_NAME|" .env
sudo -u www-data sed -i "s|DB_USERNAME=.*|DB_USERNAME=$DB_USER|" .env
sudo -u www-data sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=$DB_PASS|" .env

# 5. Setup database
print_step "9. Setup database..."
print_warning "Pastikan MySQL/MariaDB sudah running dan accessible"

# Create database and user
mysql -u root -p << EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF

if [ $? -eq 0 ]; then
    print_status "Database berhasil dibuat"
else
    print_error "Gagal membuat database, periksa credential MySQL"
    exit 1
fi

# 6. Run migrations
print_step "10. Jalankan migrasi database..."
sudo -u www-data php artisan migrate --force

# 7. Create admin user
print_step "11. Membuat user admin..."
sudo -u www-data php artisan tinker --execute="
use App\Models\User;
User::create([
    'name' => 'Administrator',
    'email' => '$ADMIN_EMAIL',
    'password' => bcrypt('$ADMIN_PASS'),
    'email_verified_at' => now()
]);
echo 'Admin user created successfully';
"

# 8. Optimize for production
print_step "12. Optimasi untuk production..."
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan storage:link

# 9. Configure web server
print_step "13. Konfigurasi web server..."

if [ "$WEBSERVER" = "nginx" ]; then
    # Nginx configuration
    sudo tee /etc/nginx/sites-available/aplikasi-madiun > /dev/null << EOF
server {
    listen 80;
    server_name $DOMAIN www.$DOMAIN;
    root /var/www/aplikasi_madiun/public;
    index index.php index.html;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Handle requests
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    # PHP handling
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
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
EOF

    # Enable site
    sudo ln -sf /etc/nginx/sites-available/aplikasi-madiun /etc/nginx/sites-enabled/
    sudo nginx -t && sudo systemctl reload nginx
    
elif [ "$WEBSERVER" = "apache" ]; then
    # Apache configuration
    sudo tee /etc/apache2/sites-available/aplikasi-madiun.conf > /dev/null << EOF
<VirtualHost *:80>
    ServerName $DOMAIN
    ServerAlias www.$DOMAIN
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

    ErrorLog \${APACHE_LOG_DIR}/aplikasi-madiun_error.log
    CustomLog \${APACHE_LOG_DIR}/aplikasi-madiun_access.log combined
</VirtualHost>
EOF

    # Enable site
    sudo a2ensite aplikasi-madiun.conf
    sudo systemctl reload apache2
fi

# 10. Setup SSL if requested
if [[ $SSL_INSTALL =~ ^[Yy]$ ]]; then
    print_step "14. Install SSL certificate..."
    
    # Install certbot if not exists
    if ! command -v certbot &> /dev/null; then
        sudo apt update
        if [ "$WEBSERVER" = "nginx" ]; then
            sudo apt install -y certbot python3-certbot-nginx
        else
            sudo apt install -y certbot python3-certbot-apache
        fi
    fi
    
    # Generate certificate
    if [ "$WEBSERVER" = "nginx" ]; then
        sudo certbot --nginx -d $DOMAIN -d www.$DOMAIN --non-interactive --agree-tos --email $ADMIN_EMAIL
    else
        sudo certbot --apache -d $DOMAIN -d www.$DOMAIN --non-interactive --agree-tos --email $ADMIN_EMAIL
    fi
    
    # Setup auto-renewal
    sudo systemctl enable certbot.timer
    print_status "SSL certificate berhasil diinstall"
fi

# 11. Setup cron jobs
print_step "15. Setup cron jobs..."
(sudo crontab -l 2>/dev/null; echo "* * * * * cd /var/www/aplikasi_madiun && php artisan schedule:run >> /dev/null 2>&1") | sudo crontab -
(sudo crontab -l 2>/dev/null; echo "0 2 * * * cd /var/www/aplikasi_madiun && php artisan backup:aplikasis") | sudo crontab -

# 12. Final checks
print_step "16. Verifikasi instalasi..."
sudo -u www-data php artisan about > /dev/null

if [ $? -eq 0 ]; then
    print_status "Aplikasi berhasil diinstall!"
else
    print_error "Ada masalah dengan instalasi, cek log error"
    exit 1
fi

# Print success message
echo
echo "=================================================="
echo -e "${GREEN}✅ INSTALASI SELESAI!${NC}"
echo "=================================================="
echo
echo "🌐 URL Aplikasi: https://$DOMAIN"
echo "👤 Admin Email: $ADMIN_EMAIL"
echo "🔑 Admin Password: [yang Anda masukkan]"
echo
echo "📁 Directory: /var/www/aplikasi_madiun"
echo "📋 Config: /var/www/aplikasi_madiun/.env"
echo "📊 Logs: /var/www/aplikasi_madiun/storage/logs/"
echo
echo "🔧 Untuk troubleshooting:"
echo "   - sudo -u www-data php artisan about"
echo "   - sudo tail -f /var/www/aplikasi_madiun/storage/logs/laravel.log"
echo "   - sudo systemctl status $WEBSERVER"
echo
echo "📚 Dokumentasi lengkap: INSTALLATION_GUIDE.md"
echo
print_warning "Jangan lupa untuk:"
echo "   1. Backup database secara berkala"
echo "   2. Update sistem dan dependencies"
echo "   3. Monitor log aplikasi"
echo "   4. Test fungsi import CSV jika diperlukan"
echo
echo "🎉 Selamat! Aplikasi Data Aplikasi Kabupaten Madiun siap digunakan!"
