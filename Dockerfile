FROM php:8.2-cli

# Cài extension cần thiết
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl \
    && docker-php-ext-install pdo pdo_mysql

# Cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set thư mục làm việc
WORKDIR /var/www

# Copy code
COPY . .

# Cài dependency
RUN composer install --no-dev --optimize-autoloader

# Generate key (tránh lỗi)
RUN php artisan key:generate

# Cache config
RUN php artisan config:cache

# Expose port
EXPOSE 10000

# Start server
CMD php artisan serve --host=0.0.0.0 --port=10000