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
    python2 \
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

# Instala Node.js 12 (binário oficial, o repo APT da NodeSource para a v12 foi descontinuado) e NPM 8
RUN curl -fsSL https://nodejs.org/dist/v12.22.12/node-v12.22.12-linux-x64.tar.xz -o /tmp/node.tar.xz \
    && tar -xJf /tmp/node.tar.xz -C /usr/local --strip-components=1 \
    && rm -f /tmp/node.tar.xz \
    && npm install -g npm@8

# Evita que o npm rebaixe privilégios ao rodar como root sobre o bind mount /application
# (owner != root), o que causava conflito de permissão com o cache em /root/.npm
RUN npm config set unsafe-perm true --global

# Alguns passos do build (ex: compilação nativa do node-sass) rodam com uid diferente
# do restante do processo, deixando o cache em /root/.npm com donos mistos e o
# npm passa a recusar gravações (EACCES). Usar /tmp (sempre gravável, sticky bit)
# como HOME evita esse conflito de ownership.
ENV HOME=/tmp

# Copia e define o entrypoint do container
COPY phpdocker/php-fpm/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
EXPOSE 5050
ENTRYPOINT ["/bin/bash", "/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
