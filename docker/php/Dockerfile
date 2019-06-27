FROM php:7.2-fpm-alpine

#GOSU
RUN apk add gosu --update --no-cache --repository http://dl-3.alpinelinux.org/alpine/edge/testing/ --allow-untrusted \
    && addgroup bar \
    && adduser -D -h /home -s /bin/sh -G bar foo \
    && mkdir -p /srv/app

#LIB PHP
RUN apk add --no-cache --virtual .build-deps $PHPIZE icu-dev postgresql-dev gnupg make autoconf git zlib-dev curl \
    && docker-php-ext-install zip opcache json intl mysqli pdo pdo_mysql pdo_pgsql pgsql \
    && docker-php-ext-enable mysqli

# imagick
RUN apk add --update --no-cache autoconf g++ imagemagick-dev libtool make pcre-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apk del autoconf g++ libtool make pcre-dev

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /srv/app

ADD entrypoint.sh /entrypoint

EXPOSE 3306

ENTRYPOINT ["/entrypoint"]