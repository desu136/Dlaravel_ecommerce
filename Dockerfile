# -----------------------------
# Stage 1: Build PHP Application
# -----------------------------
FROM php:8.2-fpm AS php-build

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Optimize Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache


# -----------------------------
# Stage 2: Run Application
# -----------------------------
FROM php:8.2-fpm

# Copy Laravel from build
WORKDIR /var/www
COPY --from=php-build /var/www /var/www

# Ensure storage is writable
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8080

# Run Laravel on Render
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8080
