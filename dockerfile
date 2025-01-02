FROM php:8.2.27-apache

RUN apt-get update && \
    apt-get install -y

RUN apt-get install -y curl vim wget git curl libgdal-dev \
    build-essential libssl-dev zlib1g-dev libpng-dev \
    libjpeg-dev libfreetype6-dev libonig-dev libicu-dev \
    libzip-dev unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY . /var/www/html

COPY /docker/denteasy.conf /etc/apache2/sites-enabled/000-default.conf

RUN docker-php-ext-install intl opcache pdo_mysql mysqli pdo mbstring zip gd

RUN docker-php-ext-configure intl && docker-php-ext-configure gd

RUN docker-php-ext-enable mysqli && docker-php-ext-enable gd && docker-php-ext-enable intl && docker-php-ext-enable opcache

RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini

RUN echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini

ARG uid=1000

RUN useradd -G www-data,root -u $uid -d /home/denteasy denteasy

RUN mkdir -p /home/denteasy/.composer && chown -R denteasy:denteasy /home/denteasy

RUN service apache2 restart

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html && a2enmod rewrite && a2enmod headers proxy_http

USER www-data

EXPOSE 80
EXPOSE 443