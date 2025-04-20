# Utilise une image PHP avec Apache
FROM php:8.1-apache

# Installation des extensions PHP utiles à CodeIgniter
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Active le module Apache rewrite (souvent nécessaire pour CodeIgniter)
RUN a2enmod rewrite

# Copie le contenu du projet dans le dossier web
COPY . /var/www/html

# Donne les bons droits aux fichiers (ajuste selon structure)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Active les erreurs PHP pour le dev (optionnel)
RUN echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/error.ini

# Configure Apache pour autoriser le rewrite
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>" >> /etc/apache2/apache2.conf

EXPOSE 80
