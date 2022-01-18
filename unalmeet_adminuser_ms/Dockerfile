FROM php:8.0.5-apache
RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libicu-dev \
        libxml2-dev \
        libpq-dev \
        libzip-dev \
        && docker-php-ext-install mysqli pdo pdo_mysql  zip intl soap opcache 
RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY src/app/composer.json /var/www/laravel_docker/composer.json
COPY src/app/composer.lock /var/www/laravel_docker/composer.lock
WORKDIR /var/www/laravel_docker
RUN composer install --no-dev --no-autoloader --no-scripts
COPY src/app .
RUN composer install --no-dev --optimize-autoloader
COPY  ./000-default.conf /etc/apache2/sites-available/000-default.conf
COPY  ./default.conf /etc/apache2/sites-available/default.conf
RUN chown -R www-data:www-data storage/
WORKDIR /var/www/laravel_docker/public
EXPOSE 80