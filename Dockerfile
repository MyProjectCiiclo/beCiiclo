FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl \
    && docker-php-ext-install pdo pdo_mysql bcmath mbstring zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# tạo env để tránh lỗi
RUN cp .env.example .env || true

# clear cache composer (tránh lỗi linh tinh)
RUN composer clear-cache

# cài dependency (debug full log)
RUN composer install -vvv --no-interaction

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000