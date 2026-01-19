FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache bash libpng libpng-dev oniguruma-dev icu-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring intl xml opcache pdo_pgsql \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install swoole \
    && docker-php-ext-enable swoole \
    && apk del .build-deps

COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["docker-entrypoint.sh"]
