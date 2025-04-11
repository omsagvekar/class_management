FROM php:7.4-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# 🧩 Install mysqli and restart Apache
RUN docker-php-ext-install mysqli \
    && service apache2 restart

# Copy source files
COPY ./app/ /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 81
