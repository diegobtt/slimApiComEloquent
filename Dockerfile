# Dockerfile

# Usando a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instalar extensões do PHP necessárias para conectar ao MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar o mod_rewrite do Apache
RUN a2enmod rewrite

# Copiar o código da API para o diretório raiz do Apache
COPY . /var/www/html

# Definir permissões para o diretório raiz do Apache
RUN chown -R www-data:www-data /var/www/html

# Expor a porta 80
EXPOSE 80
