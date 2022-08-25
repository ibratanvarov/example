FROM ginger.alifshop.uz:443/images/php/cli-8.0:base

RUN apk add --no-cache unzip

RUN curl -s https://getcomposer.org/composer.phar > /usr/local/bin/composer \
    && chmod a+x /usr/local/bin/composer && rm -rf /root/.composer/cache

WORKDIR /app

COPY ./ ./
