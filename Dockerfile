# Base image
FROM php:8.2-apache

# Install system dependencies and PHP modules
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libxslt-dev \
    libssl-dev \
    libbz2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mysqli \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        intl \
        bcmath \
        soap \
        xsl \
        curl \
        opcache \
        xml \
        fileinfo \
        bz2

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy custom php.ini
COPY php.ini /usr/local/etc/php/

# Set working directory
WORKDIR /var/www/html

