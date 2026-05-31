FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN echo "APP_DEBUG=true" > .env && \
    echo "APP_KEY=" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env && \
    echo "DB_HOST=dpg-d8dt89favr4c73843q00-a" >> .env && \
    echo "DB_PORT=5432" >> .env && \
    echo "DB_DATABASE=medicos_db_01" >> .env && \
    echo "DB_USERNAME=medicos_db_01_user" >> .env && \
    echo "DB_PASSWORD=8NBIY7yPEkXkb4cyxcntghiwu5bQqWoC" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    composer install --no-dev --optimize-autoloader && \
    php artisan key:generate --force && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
