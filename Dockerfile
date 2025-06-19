# Dockerfile
FROM php:8.2-fpm

# Instala dependências de sistema
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    libzip-dev \
    libpng-dev \
    gnupg \
    ca-certificates \
    && docker-php-ext-install pdo pdo_mysql zip bcmath

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala o Node.js (LTS) e npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www
