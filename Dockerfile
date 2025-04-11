FROM php:7.4-apache

# Copy source files
COPY ./app/ /var/www/html/

# Enable mod_rewrite if needed (for Laravel, routing, etc.)
RUN a2enmod rewrite

# 🧩 Install mysqli extension
RUN docker-php-ext-install mysqli

# Set permissions (optional but useful)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 81
