FROM php:8.2-cli

WORKDIR /app

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto
COPY . .

# Instalar dependencias PHP
RUN composer install

# Permisos Laravel
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
