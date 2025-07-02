FROM php:7.4-fpm

WORKDIR /application

ARG DEBIAN_FRONTEND=noninteractive

# Atualiza os pacotes do sistema e instala dependências necessárias
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    curl \
    libjpeg-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libxslt1-dev \
    libicu-dev \
    build-essential \
    python3 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Instala extensões PHP usando docker-php-ext-install
RUN docker-php-ext-install \
    mysqli \
    gd \
    intl \
    xsl \
    zip \
    pdo \
    pdo_mysql

    # Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala Node.js 12 e NPM 8
RUN curl -fsSL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@8 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copia e define o entrypoint do container
COPY phpdocker/php-fpm/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/bin/bash", "/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
