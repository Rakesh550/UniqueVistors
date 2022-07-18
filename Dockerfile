#FROM php:7.3-fpm

# Update system core

#RUN apt update && apt install -y \
 #       libfreetype6-dev \
  #      libjpeg62-turbo-dev \
   #     libpng-dev libxml2-dev libcurl4-gnutls-dev


#RUN docker-php-ext-install -j$(nproc) mysqli \
 #   && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  #  && docker-php-ext-install -j$(nproc) gd

# Start PHP-FPM
#CMD ["php-fpm"]

FROM php:7-apache
#FROM php:7.2-fpm-alpine
RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# Installes the mySQL client library pdo_mysql.
#RUN docker-php-ext-install pdo_mysql

#RUN RUN docker-php-ext-install nd_mysqli pdo pdo_mysql && docker-php-ext-enable nd_mysqli

# Uncomment if you require the gd php extension
# RUN apt-get update && \
#     apt-get install -y libfreetype6-dev libjpeg62-turbo-dev && \
#     docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
#     docker-php-ext-install gd

# Uncomment if you require opcache
# RUN docker-php-ext-install opcache

# Uncomment if you requrie apache rewrite mod.
# RUN a2enmod rewrite

# Uncomment to enable xdebug
# RUN pecl install xdebug-beta &&\
#     docker-php-ext-enable xdebug &&\
#     echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
#     echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
#     echo "xdebug.remote_connect_back=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
#     echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
#     echo "xdebug.profiler_enable=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
#     echo "xdebug.profiler_output_dir=\"/var/www/html\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
#     echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini &&\
#     echo "xdebug.remote_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apt-get clean
