# Use a imagem base oficial do PHP 7.4.33
FROM php:7.4.33-cli

ENV TZ=America/Sao_Paulo

# Instale extensões do PHP necessárias (se houver)
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \ 
    && echo $TZ > /etc/timezone \
    && printf '[Date]\ndate.timezone="%s"\n', $TZ > /usr/local/etc/php/conf.d/tzone.ini \
    && apt-get update && apt-get install -y \
    libxml2-dev \
    libjpeg-dev \ 
    libpng-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    gd 


COPY . /app

WORKDIR /app