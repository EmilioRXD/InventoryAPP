#!/bin/sh
set -e

chmod -R a+rwX /var/www/html/modulos \
    /var/www/html/impresora.ini \
    /var/www/html/tema.txt \
    /var/www/html/datos_empresa.txt 2>/dev/null || true

exec docker-php-entrypoint apache2-foreground