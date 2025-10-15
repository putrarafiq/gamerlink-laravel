# Dockerfile untuk Laravel (PHP 8.2)
FROM php:8.2-apache

# Install dependencies dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev curl sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Install Composer dari image resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Atur working directory
WORKDIR /var/www/html

# Copy semua file project ke container
COPY . .

# Ubah izin folder storage dan cache
RUN chown -R www-data:www-data storage bootstrap/cache || true

# Install dependensi composer (production)
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# Buat file SQLite kosong agar bisa migrate
RUN touch database/database.sqlite || true
RUN chown -R www-data:www-data database || true

# Generate key Laravel
RUN php artisan key:generate --force

# Jalankan migrasi database (abaikan error jika tabel sudah ada)
RUN php artisan migrate --force || true

# Buat symbolic link ke storage
RUN php artisan storage:link || true

# Expose port 80
EXPOSE 80

# Jalankan Laravel pakai php artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
