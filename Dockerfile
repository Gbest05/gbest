FROM php:8.2-apache

# Enable mod_rewrite and headers
RUN a2enmod rewrite headers

# Install necessary PHP extensions (GD, SQLite, PDO)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_sqlite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure Apache virtual host and DirectoryIndex
RUN echo '<Directory /var/www/html/>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n\
DirectoryIndex index.php index.html' > /etc/apache2/conf-available/gbest.conf \
    && a2enconf gbest

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Set correct permissions for Apache www-data user on data files and uploads
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/data \
    && chmod -R 775 /var/www/html/assets/images

# Render dynamically assigns a PORT (defaulting to 80 or 10000)
ENV PORT=80

# Create entrypoint script to dynamically configure port and start Apache
RUN echo '#!/bin/sh\n\
set -e\n\
PORT_TO_USE="${PORT:-80}"\n\
sed -i "s/Listen [0-9]*/Listen ${PORT_TO_USE}/g" /etc/apache2/ports.conf 2>/dev/null || true\n\
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost \*:${PORT_TO_USE}>/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true\n\
exec apache2-foreground' > /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80 10000

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
