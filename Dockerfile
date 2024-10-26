FROM php:8.2-apache

RUN a2enmod rewrite \
     && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
     && mv /var/www/html /var/www/public \
    && apt update \
&& docker-php-ext-install mysqli pdo pdo_mysql \
 && apt-get install -y vim git zlib1g-dev mariadb-client libzip-dev \
 && docker-php-ext-install zip pdo pdo_mysql \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && echo 'xdebug.mode=debug' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.client_host=host.docker.internal' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.remote_client_port=9003' >>  /usr/local/etc/php/conf.d/xdebug.ini \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer \

# Configure Xdebug (you'll need to adjust the settings for your environment)
COPY ./docker/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Set the working directory in the container
WORKDIR /var/www/

EXPOSE 80
