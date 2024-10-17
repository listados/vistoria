# Use a imagem base do PHP com FPM
FROM php:7.4-fpm

# Instala dependências do sistema e extensões do PHP necessárias
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml

# Instala o Composer
COPY --from=composer:1 /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Define permissões de pastas para o Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Porta que o PHP-FPM usará
EXPOSE 9000

CMD ["php-fpm"]
