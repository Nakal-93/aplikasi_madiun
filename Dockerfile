# Multi-stage Dockerfile untuk Aplikasi Data Aplikasi Kabupaten Madiun
# Production-ready dengan optimasi dan security

# ================================
# Stage 1: Build Dependencies
# ================================
FROM node:18-alpine AS node-builder

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install Node dependencies
RUN npm ci --only=production && npm cache clean --force

# Copy source files dan build assets
COPY . .
RUN npm run build

# ================================
# Stage 2: PHP Dependencies
# ================================
FROM composer:2.6 AS composer-builder

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies (production only)
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-suggest \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# ================================
# Stage 3: Production Image
# ================================
FROM php:8.2-fpm-alpine AS production

# Metadata
LABEL maintainer="Kabupaten Madiun"
LABEL description="Aplikasi Data Aplikasi Kabupaten Madiun - Production Container"
LABEL version="1.0.0"

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    mysql-client \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libzip-dev \
    icu-dev \
    && rm -rf /var/cache/apk/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    gd \
    intl \
    opcache

# Install Redis extension
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

# Configure PHP for production
COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Configure Nginx
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf

# Configure Supervisor
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create application user
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -D -S -G www www

# Set working directory
WORKDIR /var/www/html

# Copy application files dari build stages
COPY --from=composer-builder --chown=www:www /app/vendor ./vendor
COPY --from=node-builder --chown=www:www /app/public/build ./public/build
COPY --chown=www:www . .

# Set permissions
RUN chown -R www:www /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Create required directories
RUN mkdir -p \
    /var/log/nginx \
    /var/log/supervisor \
    /run/nginx \
    && chown -R www:www /var/log/nginx /var/log/supervisor /run/nginx

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=60s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

# Expose port
EXPOSE 80

# Switch to www user
USER www

# Set environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
