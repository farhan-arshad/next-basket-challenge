FROM ubuntu:bionic

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
    apt-get -y install software-properties-common && \
    # add-apt-repository ppa:ondrej/php && \
    # add-apt-repository ppa:sergey-dryabzhinsky/php74 && \
    # add-apt-repository ppa:sergey-dryabzhinsky/php7-modules && \
    # add-apt-repository ppa:sergey-dryabzhinsky/backports && \
    # add-apt-repository ppa:sergey-dryabzhinsky/packages && \
    apt-get update
    
RUN apt-get install -y \
        unzip \
        git \
        nano \
        iputils-ping \
        apache2 \
        curl \
        php \
        php-bz2 \
        php-dev \
        php-intl \
        php-gd \
        php-bcmath \
        php-json \
        php-ldap \
        php-mysql \
        php-xsl \
        php-mbstring \
        php-curl \
        php-soap \
        php-pgsql \
        php-xmlrpc \
        php-zip \
        php-igbinary \
        php-memcache \
        php-pear \
        php-gearman \
        gearman-job-server \
        mysql-client \
		nodejs \
        ca-certificates

# Install XDebug if configured
ARG INSTALL_XDEBUG
RUN if [ "${INSTALL_XDEBUG}" = "true" ]; then \
    apt-get install -y php-xdebug \
;fi

RUN mkdir -p /var/run/apache2 && \
    mkdir -p /etc/apache2/ssl

COPY ssl/server.crt /etc/apache2/ssl/server.crt
COPY ssl/server.key /etc/apache2/ssl/server.key
COPY conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY conf/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY conf/php-cli.ini /etc/php//cli/php.ini
COPY conf/php.ini /etc/php//apache2/php.ini
COPY init.sh /usr/local/bin/init.sh


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod +x /usr/local/bin/init.sh

RUN a2enmod rewrite ssl
RUN a2ensite 000-default default-ssl

HEALTHCHECK --interval=5s --timeout=3s --retries=3 CMD curl -f http://localhost || exit 1

EXPOSE 80 443

ENTRYPOINT /usr/local/bin/init.sh