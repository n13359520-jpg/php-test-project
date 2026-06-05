FROM php:8.2-fpm

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html

COPY app/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html

RUN groupadd -g 1000 appuser && \
    useradd -u 1000 -g appuser -m appuser

USER appuser
