# Utilise une image PHP officielle avec Apache
FROM php:8.1-apache

# Installe les extensions nécessaires pour CodeIgniter
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Active le module Apache rewrite
RUN a2enmod rewrite

# Copie le projet dans le container
COPY . /var/www/html

# Installer Composer et les dépendances PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
RUN composer install --no-interaction --prefer-dist

# Définir le bon document root si le projet utilise un dossier public/
RUN if [ -d "public" ]; then \
    sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    echo "<Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>" >> /etc/apache2/apache2.conf ; \
else \
    echo "<Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>" >> /etc/apache2/apache2.conf ; \
fi

# Droits pour Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose le port 80
EXPOSE 80
