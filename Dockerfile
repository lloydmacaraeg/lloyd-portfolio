# Production image for Render (or any Docker host).
FROM php:8.3-apache

# Apache modules and PHP hardening.
RUN a2enmod rewrite headers \
    && sed -ri 's/^ServerTokens .*/ServerTokens Prod/; s/^ServerSignature .*/ServerSignature Off/' /etc/apache2/conf-available/security.conf \
    && { \
        echo 'expose_php=Off'; \
        echo 'display_errors=Off'; \
        echo 'log_errors=On'; \
        echo 'session.use_strict_mode=1'; \
        echo 'session.cookie_httponly=1'; \
    } > /usr/local/etc/php/conf.d/portfolio.ini \
    && { \
        echo '<Directory /var/www/html>'; \
        echo '    AllowOverride All'; \
        echo '    Require all granted'; \
        echo '</Directory>'; \
    } > /etc/apache2/conf-available/portfolio.conf \
    && a2enconf portfolio

WORKDIR /var/www/html
COPY . /var/www/html/

# storage/ must be writable (only used when MAIL_MODE=log).
RUN mkdir -p storage && chown -R www-data:www-data storage

# Render provides $PORT (default 10000). Apache is pointed at it on start.
ENV PORT=10000
EXPOSE 10000


CMD ["sh", "-c", "set -e; sed -ri \"s/^[[:space:]]*Listen[[:space:]]+[0-9]+/Listen ${PORT:-10000}/\" /etc/apache2/ports.conf; sed -ri \"s/<VirtualHost \\*:[0-9]+>/<VirtualHost *:${PORT:-10000}>/g\" /etc/apache2/sites-available/000-default.conf; echo \"Starting Apache on port ${PORT:-10000}\"; exec apache2-foreground"]

