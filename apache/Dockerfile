FROM php:8.0-apache
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    curl \
    vim \
    git

# RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ADD 000-default.conf /etc/apache2/sites-enabled/
