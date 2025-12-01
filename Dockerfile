FROM php:8.2-fpm

# Системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev

# PHP расширения
RUN docker-php-ext-install pdo pdo_pgsql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader

# Очистка кешей (но не key:generate)
RUN php artisan config:clear || true
RUN php artisan route:clear || true

# -----------------------------
# Теперь миграции выполняем ТОЛЬКО на старте контейнера
# -----------------------------
CMD php artisan migrate --force || true && \
    php artisan serve --host=0.0.0.0 --port=10000
