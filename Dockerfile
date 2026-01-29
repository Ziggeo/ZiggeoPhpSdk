FROM php:8.3-cli

LABEL maintainer="ziggeo support@ziggeo.com"

RUN apt-get update && apt-get install -y git unzip && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && cp /usr/local/bin/composer /usr/bin/composer
RUN useradd -m userToRunComposer

WORKDIR /ziggeo
ADD ./classes /ziggeo/classes
ADD ./demos /ziggeo/demos
ADD ./tests /ziggeo/tests
ADD ./composer.json /ziggeo/composer.json
ADD ./Ziggeo.php /ziggeo/Ziggeo.php

RUN mkdir /ziggeo/vendor
RUN chown -R userToRunComposer /ziggeo
USER userToRunComposer
RUN composer install
