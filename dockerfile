# Use a imagem oficial do PHP com Apache como base
FROM php:8.2-apache

# Atualiza os pacotes e instala as dependências necessárias
RUN apt-get update \
    && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && a2enmod rewrite

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Verifica se o Composer foi instalado corretamente
RUN composer --version

# Copia o arquivo de configuração do VirtualHost do Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Define o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copia o código fonte do Laravel para o diretório de trabalho
COPY . .

# Define as permissões adequadas para o diretório de armazenamento do Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Tente instalar as dependências do PHP usando o Composer e verifique a saída
RUN composer install || (cat composer.lock && exit 1)

# Verifica se a pasta vendor foi criada
RUN ls -la vendor

# Expõe a porta 80 para acesso HTTP
EXPOSE 80

# Comando padrão para iniciar o servidor Apache em segundo plano
CMD ["apache2-foreground"]