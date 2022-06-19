FROM php:7.4-apache

# Install system dependencies
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN apt-get -y update
RUN apt-get -y install git
RUN apt-get -y install zip
RUN apt-get -y install unzip
RUN apt-get -y install  cron


# install CronTab
COPY custom-crontab /etc/cron.d/custom-crontab
RUN chmod 0644 /etc/cron.d/custom-crontab && crontab /etc/cron.d/custom-crontab


# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

## Set working directory
WORKDIR /var/www/html/composer

