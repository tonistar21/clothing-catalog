FROM php:8.2-cli AS phpbase
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

FROM composer:2 AS vendor
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

FROM node:20 AS build
WORKDIR /app
COPY package*.json vite.config.* postcss.config.* tailwind.config.* ./
RUN npm install
COPY resources ./resources
COPY public ./public
RUN npm run build

FROM phpbase
WORKDIR /var/www/html
COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=build /app/public/build ./public/build
RUN chmod -R 775 storage bootstrap/cache
ENV PORT=10000
CMD php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=${PORT}
