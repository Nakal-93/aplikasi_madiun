#!/usr/bin/env bash
set -e

# Pastikan cache bersih & tidak refer ke dev providers
php artisan optimize:clear || true
rm -f bootstrap/cache/*.php || true
rm -rf storage/framework/cache/data/* || true

# Discover ulang sesuai deps production
php artisan package:discover --ansi || true

# Cache di production
if [ "${APP_ENV}" = "production" ]; then
  php artisan config:cache || true
  php artisan route:cache || true
  php artisan view:cache || true
fi

exec "$@"
