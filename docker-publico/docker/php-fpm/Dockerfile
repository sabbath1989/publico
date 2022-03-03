FROM php:8.0.3-fpm
#FROM php:8.1.3-fpm
#FROM php:7.4.3-fpm

WORKDIR /publico/backend

RUN apt-get update && apt-get install -y --allow-unauthenticated \
    gnupg \
    libcurl4-openssl-dev \
    libzip-dev \
    git \
    nano \
    sendmail \
    wget \
    #bsdtar \
    libaio1 \
    poppler-utils \
    iputils-ping \
    ghostscript \
    libtesseract-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install curl \
    && docker-php-ext-install zip;

RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli;

RUN apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick

RUN docker-php-ext-install calendar && docker-php-ext-configure calendar
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

#RUN wget -qO- https://raw.githubusercontent.com/caffeinalab/php-fpm-oci8/master/oracle/instantclient-basic-linux.x64-12.2.0.1.0.zip | bsdtar -xvf- -C /usr/local && \
#    wget -qO- https://raw.githubusercontent.com/caffeinalab/php-fpm-oci8/master/oracle/instantclient-sdk-linux.x64-12.2.0.1.0.zip | bsdtar -xvf-  -C /usr/local && \
#    wget -qO- https://raw.githubusercontent.com/caffeinalab/php-fpm-oci8/master/oracle/instantclient-sqlplus-linux.x64-12.2.0.1.0.zip | bsdtar -xvf- -C /usr/local && \
#    ln -s /usr/local/instantclient_12_2 /usr/local/instantclient && \
#    ln -s /usr/local/instantclient/libclntsh.so.* /usr/local/instantclient/libclntsh.so && \
#    ln -s /usr/local/instantclient/lib* /usr/lib && \
#    ln -s /usr/local/instantclient/sqlplus /usr/bin/sqlplus
#
#RUN echo 'instantclient,/usr/local/instantclient/' | pecl install oci8-2.2.0 \
## RUN echo 'instantclient,/usr/local/instantclient/' | pecl install oci8 \
#    && docker-php-ext-enable oci8 \
#    && docker-php-ext-configure pdo_oci --with-pdo-oci=instantclient,/usr/local/instantclient \
#    && docker-php-ext-install pdo_oci

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN cd ~ \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer;

#RUN yes | pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20160303/xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini\
#    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_host = host.docker.internal"   >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# install pre requisites
#RUN apt-get update
#RUN apt-get install -y apt-transport-https
#RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
#RUN curl https://packages.microsoft.com/config/ubuntu/16.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
#RUN apt-get update
#RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
#RUN curl https://packages.microsoft.com/config/ubuntu/18.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
#RUN apt-get update
#RUN ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools
#RUN apt-get install -y unixodbc
#RUN apt-get install -y unixodbc-dev
#
## install driver sqlsrv
#RUN pecl install sqlsrv
#RUN echo "extension=sqlsrv.so" >> /usr/local/etc/php/php.ini
#RUN pecl install pdo_sqlsrv
#RUN echo "extension=pdo_sqlsrv.so" >> /usr/local/etc/php/php.ini
#
## load driver sqlsrv
#RUN echo "extension=/usr/lib/php/20151012/sqlsrv.so" >> /usr/local/etc/php/php.ini
#RUN echo "extension=/usr/lib/php/20151012/pdo_sqlsrv.so" >> /usr/local/etc/php/php.ini

# install locales
RUN apt-get install -y locales && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && locale-gen

RUN sed -i 's,^\(MinProtocol[ ]*=\).*,\1'TLSv1.0',g' /etc/ssl/openssl.cnf
RUN sed -i 's,^\(CipherString[ ]*=\).*,\1'DEFAULT@SECLEVEL=1',g' /etc/ssl/openssl.cnf

RUN echo 'memory_limit = 2G ' >> /usr/local/etc/php/php.ini
RUN echo 'max_input_vars = 1000000 ' >> /usr/local/etc/php/php.ini
RUN echo 'max_execution_time = 120 ' >> /usr/local/etc/php/php.ini
RUN echo 'upload_max_filesize  = 10000M ' >> /usr/local/etc/php/php.ini
# RUN echo 'allow_url_include  = 1 ' >> /usr/local/etc/php/php.ini

RUN apt-get update && \
    apt-get install -y \
        libc-client-dev libkrb5-dev && \
    rm -r /var/lib/apt/lists/*
    
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install -j$(nproc) imap

COPY ./conf/policy.xml /etc/ImageMagick-6/policy.xml

COPY ./start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start
CMD ["/usr/local/bin/start"]