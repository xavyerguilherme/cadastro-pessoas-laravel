FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2dismod mpm_event mpm_worker mpm_prefork || true \
    && a2enmod mpm_prefork rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

CMD sh -c "a2dismod mpm_event mpm_worker mpm_prefork || true && a2enmod mpm_prefork && echo \"ServerName localhost\" > /etc/apache2/conf-available/servername.conf && a2enconf servername && printf \"Listen %s\n\" \"${PORT:-8080}\" > /etc/apache2/ports.conf && printf \"<VirtualHost *:%s>\n    DocumentRoot /var/www/html/public\n    <Directory /var/www/html/public>\n        AllowOverride All\n        Require all granted\n    </Directory>\n    ErrorLog /proc/self/fd/2\n    CustomLog /proc/self/fd/1 combined\n</VirtualHost>\n\" \"${PORT:-8080}\" > /etc/apache2/sites-available/000-default.conf && apache2ctl -M && apache2ctl -S && apache2-foreground"
