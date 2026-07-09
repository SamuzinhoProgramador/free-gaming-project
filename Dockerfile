# Usa uma imagem oficial do PHP com Apache já configurado
FROM php:8.2-apache

# Copia todos os arquivos do seu projeto para a pasta do servidor web
COPY . /var/www/html/

# Expõe a porta padrão do Apache
EXPOSE 80