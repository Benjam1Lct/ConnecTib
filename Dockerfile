FROM php:8.1-apache

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl mysqli pdo pdo_mysql

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Copier le code du projet dans le conteneur
COPY . /var/www/html

# Assure les bons droits
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Copier Composer depuis une image dédiée
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Aller dans le dossier du projet
WORKDIR /var/www/html

# Installer les dépendances PHP (CodeIgniter)
RUN composer install --no-interaction --prefer-dist

# Configuration Apache : autoriser les .htaccess
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

EXPOSE 80
