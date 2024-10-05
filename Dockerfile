# Use a imagem base oficial do PHP 7.4.33
FROM php:7.4.33-cli

# Instale extensões do PHP necessárias (se houver)
RUN apt-get update && apt-get install -y \
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

# Copie os arquivos da aplicação para o contêiner
COPY . /app

# Defina o diretório de trabalho
WORKDIR /app

# Comando para rodar a aplicação (ajuste conforme necessário)
#CMD ["php", "index.php"]

