# --- Base PHP image ---
FROM php:8.2-fpm

# --- Install system dependencies ---
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# --- Install Composer ---
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# --- App directory ---
WORKDIR /var/www/html

# --- Copy project ---
COPY . .

# --- Install Dependencies ---
RUN composer install --no-dev --optimize-autoloader

# --- Storage ---
RUN php artisan storage:link || true

# --- Permissions ---
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# --- Expose and run Laravel server ---
EXPOSE 8080
CMD php artisan serve --host 0.0.0.0 --port 8080
