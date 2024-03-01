REQUISITOS:

    - docker
    - docker-compose

INSTRUÇÔES:

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

docker-compose restart

docker-exec -it web bash

php artisan migrate

php artisan db:seed --class=ProductsSeeder