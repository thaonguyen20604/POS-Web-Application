FROM php:8-apache

# Install additional PHP extensions if needed
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application source code to /var/www/html/
COPY ./sources /var/www/html/

# Copy .htaccess to set DirectoryIndex
COPY ./sources/.htaccess /var/www/html/

EXPOSE 80
