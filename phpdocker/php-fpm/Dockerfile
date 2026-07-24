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

# Instala Node.js 12 e NPM 8 (via repositório do Debian, pois o script do
# NodeSource para o 12.x está descontinuado e falha na verificação da chave GPG)
RUN apt-get update && apt-get install -y --no-install-recommends \
    nodejs \
    npm \
    && npm install -g npm@8 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Evita que o npm rode como root e "abaixe" privilégio para o dono do
# diretório bind-mounted (UID do host), o que causa EACCES em /root/.npm
RUN npm config set unsafe-perm true

# Copia e define o entrypoint do container
COPY phpdocker/php-fpm/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
EXPOSE 5050
ENTRYPOINT ["/bin/bash", "/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
