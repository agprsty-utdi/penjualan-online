FROM php:8.2.4-apache

# Install required dependencies
RUN apt-get update && apt-get install -y \
    libssl-dev curl zip unzip p7zip git \
    && rm -rf /var/lib/apt/lists/*

# Install MongoDB extension using PECL
RUN pecl install mongodb

# Enable MongoDB extension
RUN docker-php-ext-enable mongodb

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

# Set environment variables
ENV COMPOSER_ALLOW_SUPERUSER 1

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer.json and composer.lock files
COPY ./penjualan-online/composer.* ./

# Install dependencies
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

# Copy existing application directory contents
COPY ./penjualan-online /var/www/html

# Menjalankan perintah Composer untuk memuat autoload dan menjalankan skrip
RUN composer dump-autoload --optimize

# Set port for application
EXPOSE 8000
