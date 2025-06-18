# Dockerfile
FROM php:8.2-fpm

# Instala o driver do MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Instala extensões adicionais se precisar
# RUN docker-php-ext-install bcmath

WORKDIR /var/www
