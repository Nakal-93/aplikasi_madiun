# 🚀 Quick Deployment Guide - Aplikasi Data Aplikasi Kabupaten Madiun

## ⚡ Instalasi Otomatis (Recommended)

### Prerequisites
- Server Ubuntu 20.04+ / Debian 11+
- Root atau sudo access
- Git, PHP 8.1+, MySQL/MariaDB, Nginx/Apache

### Langkah Instalasi Cepat

1. **Download script instalasi:**
```bash
wget https://raw.githubusercontent.com/Nakal-93/aplikasi_madiun/main/install.sh
chmod +x install.sh
```

2. **Jalankan instalasi otomatis:**
```bash
./install.sh
```

3. **Ikuti prompt interaktif:**
- Domain aplikasi
- Database credentials
- Admin user credentials
- SSL installation (optional)

### ⏱️ Estimasi Waktu: 5-10 menit

---

## 🔧 Instalasi Manual

Jika prefer instalasi manual, ikuti [INSTALLATION_GUIDE.md](INSTALLATION_GUIDE.md) untuk panduan lengkap step-by-step.

---

## ✅ Post-Installation Checklist

### 1. Verifikasi Aplikasi
```bash
cd /var/www/aplikasi_madiun
sudo -u www-data php artisan about
```

### 2. Test Login
- Buka https://yourdomain.com
- Login dengan admin credentials
- Cek menu dan fitur utama

### 3. Test Import Data (Optional)
```bash
# Backup dulu
sudo -u www-data php artisan backup:aplikasis

# Test import dengan sample data
sudo -u www-data php artisan db:seed --class=AplikasiImportSeeder
```

### 4. Monitoring Setup
```bash
# Cek log aplikasi
sudo tail -f /var/www/aplikasi_madiun/storage/logs/laravel.log

# Cek web server status
sudo systemctl status nginx  # atau apache2

# Cek database connection
sudo -u www-data php artisan tinker --execute="DB::connection()->getPdo(); echo 'Database OK';"
```

---

## 🔄 Update Aplikasi

### Auto Update Script
```bash
#!/bin/bash
cd /var/www/aplikasi_madiun

# Backup database
sudo -u www-data php artisan backup:aplikasis

# Pull latest changes
sudo git pull origin main

# Update dependencies
sudo -u www-data composer install --optimize-autoloader --no-dev
sudo -u www-data npm install && npm run build

# Run migrations
sudo -u www-data php artisan migrate --force

# Clear cache
sudo -u www-data php artisan optimize:clear
sudo -u www-data php artisan optimize

echo "Update completed!"
```

---

## 🆘 Quick Troubleshooting

### Permission Issues
```bash
sudo chown -R www-data:www-data /var/www/aplikasi_madiun
sudo chmod -R 755 /var/www/aplikasi_madiun
sudo chmod -R 775 storage bootstrap/cache
```

### Cache Issues
```bash
sudo -u www-data php artisan optimize:clear
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
```

### Database Issues
```bash
# Reset migrations (HATI-HATI!)
sudo -u www-data php artisan migrate:fresh --seed

# Check database connection
sudo -u www-data php artisan migrate:status
```

### Web Server Issues
```bash
# Nginx
sudo nginx -t
sudo systemctl restart nginx

# Apache
sudo apache2ctl configtest
sudo systemctl restart apache2
```

---

## 📱 Mobile Testing Checklist

- [ ] Login page responsive
- [ ] Navigation menu collapsible
- [ ] Tables horizontal scroll
- [ ] Forms touch-friendly
- [ ] Buttons adequate size
- [ ] Text readable on small screens

---

## 🔒 Security Checklist

- [ ] HTTPS enabled
- [ ] Debug mode disabled
- [ ] Strong database passwords
- [ ] File permissions correct
- [ ] .env file protected
- [ ] Regular backups enabled
- [ ] Updates automated

---

## 📊 Performance Optimization

### Enable OPcache (PHP)
```bash
echo "opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0" | sudo tee -a /etc/php/8.2/fpm/conf.d/10-opcache.ini

sudo systemctl restart php8.2-fpm
```

### Enable Compression (Nginx)
```nginx
gzip on;
gzip_types text/css application/javascript application/json;
gzip_min_length 1000;
```

---

## 📞 Support & Maintenance

### Regular Maintenance Tasks
- **Daily**: Monitor logs dan performance
- **Weekly**: Check for updates
- **Monthly**: Database backup verification
- **Quarterly**: Security audit

### Log Locations
- **Application**: `/var/www/aplikasi_madiun/storage/logs/laravel.log`
- **Web Server**: `/var/log/nginx/` atau `/var/log/apache2/`
- **Database**: `/var/log/mysql/`

### Backup Commands
```bash
# Manual backup
sudo -u www-data php artisan backup:aplikasis

# Restore from backup
mysql -u username -p database_name < backup_file.sql
```

---

## 🎯 Production Features

### ✅ Implemented
- ✅ Responsive mobile design
- ✅ Data import from CSV
- ✅ OPD management
- ✅ Application catalog
- ✅ Search and filters
- ✅ User authentication
- ✅ Database backups
- ✅ Production optimization
- ✅ SSL ready
- ✅ Caching enabled

### 📈 Data Statistics
- **Total Applications**: 218 (33 existing + 185 imported)
- **OPD Mappings**: 61 departments
- **Import Success Rate**: 99.5% (185/186 records)
- **Database Size**: ~500KB (optimized schema)

---

**🚀 Ready for Production!** 

Aplikasi Data Aplikasi Kabupaten Madiun telah ditest dan siap untuk deployment production dengan semua fitur lengkap dan optimasi yang diperlukan.
