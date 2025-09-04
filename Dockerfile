# ===== 0. ARG =====
ARG APP_NAME="pendataan-aplikasi"

# ===== 1) Composer vendor (no source code) =====
FROM php:8.3-cli-bookworm AS vendor
WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libicu-dev zlib1g-dev \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction --no-scripts --optimize-autoloader

# ===== 2) Frontend build (Vite) =====
FROM node:20.19-bookworm-slim AS frontend
WORKDIR /app

COPY package*.json ./
RUN --mount=type=cache,target=/root/.npm npm ci --no-audit --no-fund

# Copy seluruh repo (dibatasi .dockerignore) agar config vite/tailwind ikut
COPY . .
# Build; kalau script build tidak ada, lanjut saja
RUN npm run build || echo "Skip Vite build (script build tidak ada)"

# ===== 3) Runtime PHP-FPM =====
FROM php:8.3-fpm-bookworm AS app
WORKDIR /var/www/html

# OS & ext PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libicu-dev zlib1g-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" bcmath intl pdo_mysql zip gd opcache

# OPcache production
RUN { \
  echo 'opcache.enable=1'; \
  echo 'opcache.enable_cli=0'; \
  echo 'opcache.jit_buffer_size=0'; \
  echo 'opcache.interned_strings_buffer=16'; \
  echo 'opcache.max_accelerated_files=20000'; \
  echo 'opcache.validate_timestamps=0'; \
} > /usr/local/etc/php/conf.d/opcache.ini

# --- Copy source code (pastikan bukan root) ---
COPY --chown=www-data:www-data . .

# Bersihkan cache lama (kalau nyangkut di context)
RUN rm -f bootstrap/cache/*.php && rm -rf storage/framework/cache/data/*

# Vendor dari stage composer (bukan root)
COPY --chown=www-data:www-data --from=vendor /app/vendor ./vendor
COPY --chown=www-data:www-data --from=vendor /app/composer.json ./composer.json
COPY --chown=www-data:www-data --from=vendor /app/composer.lock ./composer.lock

# Hasil build Vite (bukan root) → ini yang bikin 404 hilang
COPY --chown=www-data:www-data --from=frontend /app/public/build ./public/build

# Permissions penting untuk runtime Laravel
RUN mkdir -p storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && find public/build -type d -exec chmod 755 {} \; 2>/dev/null || true \
 && find public/build -type f -exec chmod 644 {} \; 2>/dev/null || true

# Health endpoint
RUN printf "<?php echo 'ok';" > public/health

# Env dasar (APP_KEY idealnya via secret/env compose)
ENV APP_ENV=production \
    APP_DEBUG=false \
    APP_NAME="pendataan-aplikasi" \
    APP_KEY="base64:o5BF5OwE9iIcLq533D1D0h6DgaZhRtWoh67o19WCcus="

# Entrypoint: clear & discover DI RUNTIME (hindari Collision dev)
COPY --chown=root:root docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
