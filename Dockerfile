 
FROM php:7.4-apache

COPY ./app/ /var/www/html/

RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

EXPOSE 80
