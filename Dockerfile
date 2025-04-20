FROM php:8.2-apache

RUN a2enmod rewrite

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN docker-php-ext-install mysqli

RUN apt-get update && apt-get install -y unzip zip git curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./app/ /var/www/html/

WORKDIR /var/www/html

RUN composer install \
    && composer require --dev phpunit/phpunit ^10

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
