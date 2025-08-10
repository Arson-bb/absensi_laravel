# gunakan tag yang tersedia
FROM php:8.2.12-cli-alpine

# deps sistem + ekstensi PHP yang dibutuhkan (zip, pdo_mysql, gd)
RUN apk add --no-cache \
    git unzip libzip-dev zlib-dev \
    libpng-dev freetype-dev libjpeg-turbo-dev \
 && docker-php-ext-install zip pdo_mysql \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install gd

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# install deps pakai cache layer
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# salin source code
COPY . .

# (opsional) jalan sebagai non-root
RUN adduser -D -u 10001 appuser && chown -R appuser:appuser /app
USER appuser

# start: generate key, migrate, storage link, lalu serve
CMD php artisan key:generate --force \
 && php artisan migrate --force \
 && php artisan storage:link || true \
 && php artisan serve --host 0.0.0.0 --port ${PORT}
