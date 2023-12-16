FROM php:latest

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /app
WORKDIR /app

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --prefer-source --no-interaction

RUN php artisan migrate

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]