# syntax=docker/dockerfile:1.7

############################################
# Stage 1 - Install PHP dependencies with Composer
############################################
FROM composer:2.8 AS vendor
WORKDIR /app

# Optimize layer caching for dependencies
COPY composer.json composer.lock* ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader

############################################
# Stage 2 - Build frontend assets with Vite
############################################
FROM node:20-alpine AS assets
WORKDIR /app

COPY package.json package-lock.json* ./
RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi

COPY . ./
RUN npm run build

############################################
# Stage 3 - Production image (Nginx + PHP-FPM)
############################################
FROM webdevops/php-nginx:8.2-alpine

ENV PORT=8080 \
    WEB_PORT=8080 \
    WEB_DOCUMENT_ROOT=/app/public \
    WEB_DOCUMENT_INDEX=index.php

WORKDIR /app

# System dependencies + PHP extensions required by Laravel & PostgreSQL
RUN apk add --no-cache \
        bash \
        libpq \
        postgresql-dev \
        icu-dev \
        oniguruma-dev \
        libzip-dev \
        freetype-dev \
        libpng-dev \
        jpeg-dev \
        supervisor \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        bcmath \
        intl \
        pcntl \
        pdo_pgsql \
        pgsql \
        zip \
        gd \
    && rm -rf /var/cache/apk/*

# Copy application source
COPY . /app

# Copy vendor directory from Composer stage
COPY --from=vendor /app/vendor /app/vendor
COPY --from=vendor /app/composer.lock /app/composer.lock
COPY --from=vendor /app/composer.json /app/composer.json

# Copy built frontend assets
COPY --from=assets /app/public/build /app/public/build

# Ensure storage is writable inside the container
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs \
    && chown -R application:application storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

# Copy custom entrypoint to run artisan optimizations before boot
COPY docker/entrypoint.sh /entrypoint.d/99-laravel.sh
RUN chmod +x /entrypoint.d/99-laravel.sh

EXPOSE 8080

# Final command handled by base image (supervisord -> nginx + php-fpm)
CMD ["/opt/docker/bin/entrypoint", "supervisord"]
