#Base image
FROM php:7.2-apache

#Install postgres
RUN docker-php-ext-configure pgsql -with-pgsql=/berna/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql