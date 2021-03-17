FROM php:8.0-fpm

# htop, nano and vim, for debug purpose
RUN apt-get update && \
  apt-get install -y htop nano vim procps net-tools && \
  rm -rf /var/lib/apt/lists/*

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && \
    apt-get install zip unzip && \
    rm -rf /var/lib/apt/lists/*

# Installing other php extensions
RUN docker-php-ext-install \
    pdo pdo_mysql \
    && docker-php-source delete

WORKDIR /var/www/sbo/current

CMD php-fpm