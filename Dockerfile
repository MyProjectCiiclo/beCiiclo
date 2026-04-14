FROM php:8.2-fpm

# Cài package
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev nodejs npm

# PHP extensions
RUN docker-php-ext-install \
    pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy code
COPY . .

# Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 🔥 QUAN TRỌNG: build frontend
RUN npm install
RUN npm run build

# Quyền
RUN chown -R www-data:www-data /var/www

EXPOSE 10000

# Start app
CMD php artisan config:clear && php artisan migrate --force && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=10000