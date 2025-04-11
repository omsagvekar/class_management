FROM php:7.4-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# ✅ Allow .htaccess overrides (important for many apps, especially PHP frameworks)
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# ✅ Install mysqli (no need to restart apache manually)
RUN docker-php-ext-install mysqli

# ✅ Copy app files AFTER enabling extensions/config
COPY ./app/ /var/www/html/

# Set file permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# ✅ Important: expose the default Apache port (inside the container it's always 80)
EXPOSE 80
