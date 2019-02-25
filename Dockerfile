FROM php:apache

# copy just composer definitions
COPY composer.* /var/www/

# enable apache modules
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y zlib1g-dev libzip-dev
COPY config/server.crt /etc/apache2/ssl/server.crt
COPY config/server.key /etc/apache2/ssl/server.key
COPY config/dev.conf /etc/apache2/sites-enabled/dev.conf
RUN docker-php-ext-install mysqli pdo pdo_mysql zip mbstring
RUN a2enmod rewrite
RUN a2enmod ssl
RUN a2enmod headers
RUN service apache2 restart

# install deps
RUN set -ex; \
    apt-get update && apt-get install -y --no-install-recommends git unzip; \
    docker-php-ext-install -j$(nproc) pdo_mysql; \
    cd /var/www/; \
    curl https://getcomposer.org/composer.phar --output composer.phar; \
    php composer.phar install; \
    php composer.phar clear-cache; \
    rm composer.phar; \
    apt-get purge -y git unzip; \
    rm -r /var/lib/apt/lists/*
