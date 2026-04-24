FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev nodejs npm

RUN docker-php-ext-install \
    pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

RUN npm install
RUN npm run build

RUN chown -R www-data:www-data /var/www

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000