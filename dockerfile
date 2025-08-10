FROM php:8.2-cli-alpine

RUN apk add --no-cache \
    git unzip libzip-dev zlib-dev \
    libpng-dev freetype-dev libjpeg-turbo-dev

RUN docker-php-ext-install zip pdo_mysql
RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction
COPY . .

RUN php -r "opcache_reset();" 2>/dev/null || true

RUN adduser -D -u 10001 appuser && chown -R appuser:appuser /app
USER appuser

CMD php artisan key:generate --force \
 && php artisan migrate --force \
 && php artisan storage:link || true \
 && php artisan serve --host 0.0.0.0 --port ${PORT}
