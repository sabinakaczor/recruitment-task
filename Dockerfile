# Dockerfile
FROM php:8.1-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev nodejs npm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

WORKDIR /app
COPY . /app

RUN composer install
RUN npm install && npm run build

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000