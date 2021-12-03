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
RUN composer create-project laravel/laravel /var/www/laravel_docker


COPY  src/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY  src/default.conf /etc/apache2/sites-available/default.conf
COPY src/.env2  /var/www/laravel_docker/.env

RUN cd /var/www/laravel_docker && composer require laravel/sanctum && php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" && php artisan migrate

COPY src/Kernel.php /var/www/laravel_docker/app/http/kernel.php
COPY src/User.php /var/www/laravel_docker/app/models/user.php 
COPY src/api.php /var/www/laravel_docker/routes/api.php

RUN cd /var/www/laravel_docker &&  php artisan make:controller AuthController

COPY src/AuthController.php /var/www/laravel_docker/app/Http/Controllers/AuthController.php

RUN cd /var/www/laravel_docker && chown -R www-data:www-data storage/
WORKDIR /var/www/laravel_docker/public
EXPOSE 80