FROM php:7.2-fpm

# Update sys-deps & install necessary packages
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y --no-install-recommends \
    curl \
    libzip-dev

# Fetch & install composer
RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# Zip required for most of composer packages
RUN docker-php-ext-install zip

WORKDIR /var/www/weather-notificator