# Use PHP with Apache base image
FROM php:8.4-apache

# Install necessary PHP extensions including pdo_mysql
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html/

# Copy project files to container
COPY . .

# Open port 80
EXPOSE 80
