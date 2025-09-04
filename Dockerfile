FROM laravelphp/php-fpm

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

EXPOSE 9000
CMD ["php-fpm"]
