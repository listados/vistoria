FROM phpdockerio/php74-fpm:latest

WORKDIR /application

ARG DEBIAN_FRONTEND=noninteractive

# Instala dependências essenciais, extensões PHP e ferramentas de build para node-gyp (node-sass)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    curl \
    php7.4-mysql \
    php7.4-gd \
    php7.4-intl \
    php7.4-xsl \
    build-essential \
    python3 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Instala Node.js 12.x e NPM 8
RUN curl -fsSL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@8 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Copia e define o entrypoint do container
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/bin/bash", "/usr/local/bin/entrypoint.sh"]
CMD ["/usr/sbin/php-fpm7.4", "-F"]
