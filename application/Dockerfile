FROM php:7.4-apache
##FROM php:7.1.3-fpm
RUN docker-php-ext-install pdo pdo_mysql mysqli

#FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
#ARG user
#ARG uid

RUN apt-get -y update
RUN apt-get -y install git
RUN apt-get -y install zip
RUN apt-get -y install unzip


# Install system dependencies
#RUN apt-get update && apt-get install -y \
#    git \
#    curl \
#    libpng-dev \
#    libonig-dev \
#    libxml2-dev \
#    zip \
#    unzip

## Clear cache
#RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
#RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

## Set working directory
WORKDIR /var/www/html/assets/composer
