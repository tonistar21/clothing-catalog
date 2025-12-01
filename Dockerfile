FROM composer:2 AS composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

FROM node:20 AS node
WORKDIR /app
COPY package*.json vite.config.* postcss.config.* tailwind.config.* ./
RUN npm install
COPY resources ./resources
COPY public ./public
RUN npm run build

FROM php:8.2-cli
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y git unzip libpq-dev && docker-php-ext-install pdo pdo_pgsql && rm -rf /var/lib/apt/lists/*
COPY . .
COPY --from=composer /app/vendor ./vendor
COPY --from=node /app/public/build ./public/build
RUN chmod -R 775 storage bootstrap/cache
ENV PORT=10000
CMD php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=${PORT}
RUN php artisan route:clear || trueQ