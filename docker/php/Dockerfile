FROM php:fpm-alpine
COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD php -d memory_limit=-1 ; composer install -o ;
CMD echo "Waiting for MySQL to be up and running\n"
CMD wait-for-it database:3306
CMD echo "Executing migrations\n"
CMD php bin/console doctrine:migrations:migrate
CMD php-fpm
EXPOSE 9000