FROM php:7.4-apache

# Install system dependencies
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN apt-get -y update
RUN apt-get -y install git
RUN apt-get -y install zip
RUN apt-get -y install unzip
RUN apt-get -y  install nano
RUN apt-get -y  install cron

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY controller/cronfileTest /etc/cron.d/cronfileTest
RUN chmod 0644 /etc/cron.d/cronfileTest && \
    crontab /etc/cron.d/cronfileTest


