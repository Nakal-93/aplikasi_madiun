#!/bin/bash

echo "🚀 SCRIPT UPLOAD GITHUB"
echo "======================="
echo ""

echo "📋 Instruksi:"
echo "1. Buat Personal Access Token di GitHub"
echo "2. Jalankan script ini dan masukkan token ketika diminta"
echo ""

read -p "Apakah Anda sudah membuat Personal Access Token? (y/n): " confirm

if [ "$confirm" != "y" ]; then
    echo ""
    echo "❗ Silakan buat Personal Access Token terlebih dahulu:"
    echo "   1. Buka https://github.com/settings/tokens"
    echo "   2. Generate new token (classic)"
    echo "   3. Pilih scope 'repo'"
    echo "   4. Copy token yang dihasilkan"
    echo ""
    exit 1
fi

echo ""
read -p "Masukkan Personal Access Token GitHub: " token

if [ -z "$token" ]; then
    echo "❌ Token tidak boleh kosong!"
    exit 1
fi

echo ""
echo "🔧 Mengkonfigurasi remote dengan token..."
cd /var/www/html

# Set remote URL dengan token
sudo -u www-data git remote set-url origin https://${token}@github.com/Nakal-93/aplikasi_madiun.git

echo "📤 Uploading ke GitHub..."
sudo -u www-data git push -u origin main

if [ $? -eq 0 ]; then
    echo ""
    echo "🎉 SUCCESS!"
    echo "✅ Aplikasi berhasil diupload ke GitHub!"
    echo "🌐 Repository: https://github.com/Nakal-93/aplikasi_madiun"
    echo ""
    echo "📋 Yang sudah diupload:"
    echo "   - 93 files aplikasi Laravel"
    echo "   - Documentation lengkap"
    echo "   - Database schema & seeders"
    echo "   - UI modern dengan Tailwind CSS"
    echo ""
else
    echo ""
    echo "❌ Upload gagal!"
    echo "🔍 Periksa kembali Personal Access Token"
    echo "📝 Pastikan token memiliki scope 'repo'"
fi
