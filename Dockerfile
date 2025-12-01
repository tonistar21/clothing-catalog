FROM php:8.2-fpm

# Системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev

# Установить расширения PHP
RUN docker-php-ext-install pdo pdo_pgsql zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www/html

# Копируем проект
COPY . .

# Устанавливаем зависимости Laravel
RUN composer install --no-dev --optimize-autoloader

# Генерируем ключ, если нет
RUN php artisan key:generate --force

# Оптимизация Laravel
RUN php artisan config:clear && php artisan route:clear

# -----------------------------
# 🔥 ВАЖНО: запуск миграций при старте
# -----------------------------
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
