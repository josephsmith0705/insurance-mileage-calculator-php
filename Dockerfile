FROM php:8.0-apache
WORKDIR /var/www/html

COPY app/index.php index.php
COPY app/include/ include
EXPOSE 80