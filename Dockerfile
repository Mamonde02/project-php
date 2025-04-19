# Use PHP with Apache
FROM php:8.4-apache

# Install necessary PHP extensions
# Install PostgreSQL extension pgsql || pdo_pgsql
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Expose Apache port
EXPOSE 80
