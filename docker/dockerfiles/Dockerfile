FROM php:8.1-apache

RUN apt-get update \
  && apt-get install -y zip \
  && docker-php-ext-install bcmath \
  && curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html
COPY ./docker/apache2/apache2.conf /etc/apache2/apache2.conf
COPY ./codes/ ./

RUN composer install
RUN composer dump-autoload -o
