FROM php:8.1-cli-alpine

RUN apk update && apk add --no-cache curl g++ make autoconf bash \
    && docker-php-ext-install mysqli bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer