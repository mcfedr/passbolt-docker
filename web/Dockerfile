FROM php:7-apache

MAINTAINER Fred Cox "mcfedr@gmail.com"

RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        libicu-dev \
        libxslt-dev \
        zlib1g-dev \
        libmemcached-dev \
        libssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        libgpgme11-dev \
        curl \
   && apt-get autoremove -y \
   && apt-get clean all

RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install xsl
RUN docker-php-ext-install zip
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

ENV PHP_MEMCACHED_VERSION php7
RUN curl -L -o /tmp/memcached.tar.gz https://github.com/php-memcached-dev/php-memcached/archive/${PHP_MEMCACHED_VERSION}.tar.gz \
    && mkdir -p memcached \
    && tar xfz /tmp/memcached.tar.gz -C memcached --strip-components=1 \
    && rm -r /tmp/memcached.tar.gz \
    && ( \
      cd memcached \
      && phpize \
      && ./configure --enable-memcached \
      && make -j$(nproc) \
      && make install \
    ) \
    && rm -r memcached \
    && docker-php-ext-enable memcached
		
RUN pecl install -o -f gnupg \
    && rm -rf /tmp/pear
RUN docker-php-ext-enable gnupg

RUN echo "date.timezone=UTC" > /usr/local/etc/php/conf.d/timezone.ini
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory.ini

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN mkdir -p /opt/workspace
WORKDIR /opt/workspace
