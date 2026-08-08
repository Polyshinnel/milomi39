# syntax=docker/dockerfile:1

ARG NODE_VERSION=22

FROM node:${NODE_VERSION}-bookworm-slim AS node

FROM php:8.4-cli-bookworm

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp/composer \
    PATH="/var/www/html/vendor/bin:${PATH}"

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        git \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        exif \
        gd \
        intl \
        opcache \
        pcntl \
        pdo_mysql \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s ../lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s ../lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-scripts --prefer-dist

COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts

COPY . .
COPY docker/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/entrypoint.sh /usr/local/bin/app-entrypoint

RUN chmod 755 /usr/local/bin/app-entrypoint \
    && composer dump-autoload --optimize \
    && npm run build \
    && mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

EXPOSE 8000

ENTRYPOINT ["app-entrypoint"]
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public", "docker/server.php"]
