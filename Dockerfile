# Dockerfile
FROM php:8.1-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev nodejs npm
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libwebp-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install gd

WORKDIR /app
COPY . /app

COPY /.env.example /app/.env

RUN composer install
RUN npm install && npm run build
RUN php artisan key:generate
RUN php artisan storage:link

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000