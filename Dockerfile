FROM php:8.1-apache

# Installer extensions PHP requises + dépendances
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl mysqli pdo pdo_mysql

# Activer le mod_rewrite
RUN a2enmod rewrite

# Définir le dossier public comme racine web
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Adapter la conf Apache à ce chemin
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Copier les fichiers du projet
COPY . /var/www/html

# Droits corrects
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
RUN composer install --no-interaction --prefer-dist

# Configuration Apache pour .htaccess
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

EXPOSE 80
