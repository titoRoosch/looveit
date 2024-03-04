REQUISITOS:

    docker
    docker-compose

INSTRUÇÔES:

    copiar arquivo .env.example para .env

    docker-compose build

    docker network create looveit_laravel_app_network

    docker-compose up -d

    docker-exec -it web bash

    composer install

    php artisan key:generate

    chmod -R 775 storage/logs
    chown -R www-data:www-data storage/logs

    chmod -R 775 storage/framework/sessions
    chown -R www-data:www-data storage/framework/sessions

    chmod -R 775 storage/framework/views
    chown -R www-data:www-data storage/framework/views

    php artisan config:clear
    php artisan cache:clear

    exit

    docker-compose restart

    docker-exec -it web bash

    php artisan migrate

    php artisan db:seed --class=ProductsSeeder

OBS: Caso não vá usar os dados de DB_DATABASE, DB_USER e DB_PASSWORD é necessário alterar 
.env.testing de acordo 


TESTES unitários:

    docker-compose run --rm web vendor/bin/phpunit