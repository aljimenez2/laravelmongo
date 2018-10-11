FROM php:7.2.9-apache

MAINTAINER Alejandro Jimenez <alejandrojimenezaajr@gmail.com>

############ for laravel dockerfile ##############

# point default site to public directory

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# install composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --filename=composer --install-dir=/usr/local/bin

# install missing extensions (and locales)
RUN apt-get update && \
        apt-get install -y zlib1g-dev libicu-dev locales
RUN docker-php-ext-install mbstring zip pdo_mysql
RUN pecl install mongodb && docker-php-ext-enable mongodb
#RUN echo "extension=mongodb.so" >> /etc/php/7.2/apache2/php.ini

# Generate locale for es_AR
RUN echo "es_AR.UTF-8 UTF-8" >> /etc/locale.gen
RUN locale-gen

# enable apache modules
RUN a2enmod rewrite

# activate php error logs
RUN echo php_flag log_errors On > /etc/apache2/conf-enabled/php-log-errors.conf

#clean up
RUN apt-get clean && \
        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

############ App stuff ##########
# Copy files
WORKDIR /var/www/html


ADD ./ /var/www/html

# install vendors
# RUN composer install

RUN cp .env.example .env

# Set file owner
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80