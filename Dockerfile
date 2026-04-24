FROM php:8.2-fpm

ENV COMPOSER_MEMORY_LIMIT=-1

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev \
    nodejs npm \
    libicu-dev

RUN docker-php-ext-install \
    pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

RUN chown -R www-data:www-data /var/www

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000