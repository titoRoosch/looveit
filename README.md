# Sistema de Gerenciamento de Biblioteca

Este é um sistema de gerenciamento de produtos construído com Laravel.

## Requisitos

- Docker
- Docker-compose

## Instruções de Configuração

1. Clone este repositório em sua máquina local.
2. Copie o arquivo `.env.example` para `.env`:
    ```
    cp .env.example .env
    ```
3. Construa os contêineres Docker:
    ```
    docker-compose build
    ```
4. Crie uma rede Docker para o aplicativo:
    ```
    docker network create looveit_laravel_app_network
    ```
5. Inicie os contêineres Docker:
    ```
    docker-compose up -d
    ```
6. Acesse o contêiner da aplicação:
    ```
    docker-compose exec web bash
    ```
7. Instale as dependências do Composer:
    ```
    composer install
    ```
8. Gere a chave de aplicação:
    ```
    php artisan key:generate
    ```
9. Defina as permissões de armazenamento:
    ```
    chmod -R 775 storage/logs
    chown -R www-data:www-data storage/logs

    chmod -R 775 storage/framework/sessions
    chown -R www-data:www-data storage/framework/sessions

    chmod -R 775 storage/framework/views
    chown -R www-data:www-data storage/framework/views
    ```
10. Limpe a configuração e o cache do Laravel:
    ```
    php artisan config:clear
    php artisan cache:clear
    ```
11. Saia do contêiner:
    ```
    exit
    ```
12. Reinicie os contêineres Docker:
    ```
    docker-compose restart
    ```
13. Acesse novamente o contêiner da aplicação:
    ```
    docker-compose exec web bash
    ```
14. Execute as migrações do banco de dados:
    ```
    php artisan migrate
    ```
15. Popule o banco de dados com dados de super usuário:
    ```
    php artisan db:seed --class=ProductsSeeder
    ```

    
## Executando Testes Unitários

Para executar os testes unitários, execute o seguinte comando:

    
    docker-compose run --rm web vendor/bin/phpunit
    

Isso iniciará os contêineres Docker necessários e executará os testes unitários.
