FROM php:7.0-cli

MAINTAINER ziggeo support@ziggeo.com

RUN apt-get update
RUN apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && cp /usr/local/bin/composer /usr/bin/composer
RUN useradd userToRunComposer

WORKDIR /ziggeo
ADD ./classes /ziggeo/classes
ADD ./demos /ziggeo/demos
ADD ./composer.json /ziggeo/composer.json
ADD ./composer.lock /ziggeo/composer.lock
ADD ./Ziggeo.php /ziggeo/Ziggeo.php

RUN mkdir /ziggeo/vendor
RUN chown userToRunComposer /ziggeo/vendor
USER userToRunComposer
RUN composer install