FROM php:8.2.12-cli-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1 \
    COMPOSER_MEMORY_LIMIT=-1

RUN apk add --no-cache \
    git unzip libzip-dev zlib-dev \
    libpng-dev freetype-dev libjpeg-turbo-dev \
    libxml2-dev

RUN docker-php-ext-install pdo_mysql zip mbstring exif \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install gd \
 && docker-php-ext-install xml

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN php -v && php -m | sort && composer --version \
 && composer install --no-dev --optimize-autoloader -vvv

COPY . .

RUN adduser -D -u 10001 appuser && chown -R appuser:appuser /app
USER appuser

CMD php artisan key:generate --force \
 && php artisan migrate --force \
 && php artisan storage:link || true \
 && php artisan serve --host 0.0.0.0 --port ${PORT}
