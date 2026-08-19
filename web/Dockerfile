FROM php:7.4-apache

RUN a2enmod rewrite \
    && docker-php-ext-install pdo_mysql

COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]