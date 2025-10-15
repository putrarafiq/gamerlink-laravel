# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Install dependensi yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libpq-dev libzip-dev libpng-dev libonig-dev curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project ke container
COPY . .

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Generate key Laravel (akan otomatis di container)
RUN php artisan key:generate

# Beri izin folder storage dan bootstrap
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80
EXPOSE 80

# Jalankan Laravel menggunakan server bawaan PHP
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
