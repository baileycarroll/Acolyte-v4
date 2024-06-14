FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    curl \
    git \
    jpegoptim optipng pngquant gifsicle \
    locales \
    unzip \
    vim \
    zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions

# Graphics Draw
RUN apt-get update && apt-get install -y


# Miscellaneous
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

CMD bash -c "php-fpm"