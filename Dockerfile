FROM php:8.1-cli

# Installer dépendances nécessaires
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libicu-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install intl pdo pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le code dans le conteneur
COPY . /app
WORKDIR /app

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist

# Exposer le port sur lequel spark tourne par défaut
EXPOSE 8080

# Commande de démarrage
CMD ["php", "spark", "serve", "--host", "0.0.0.0", "--port", "8080"]
