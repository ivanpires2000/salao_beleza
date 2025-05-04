# Use a imagem base oficial do PHP com Apache
FROM mcr.microsoft.com/vscode/devcontainers/php:8.1

# Instalar extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Limpar cache do apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
