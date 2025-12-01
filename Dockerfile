# Используем официальный PHP образ
FROM php:8.2-fpm

# Устанавливаем зависимости системы
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    nodejs \
    npm

# PHP расширения
RUN docker-php-ext-install pdo pdo_pgsql zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копируем проект
COPY . .

# Устанавливаем backend зависимости
RUN composer install --no-dev --optimize-autoloader

# Устанавливаем frontend зависимости
RUN npm install

# Собираем Vite ассеты
RUN npm run build

# Чистим кеш
RUN php artisan config:clear || true
RUN php artisan route:clear || true

# На старте — прогоняем миграции и запускаем сервер
CMD php artisan migrate --force || true && \
    php artisan serve --host=0.0.0.0 --port=10000
