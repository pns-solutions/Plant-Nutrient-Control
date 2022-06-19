#!/bin/sh
docker-compose build && docker-compose up -d
docker exec -it webapplication sh -c "mkdir -p logs && chmod 755 logs"
#docker exec -it webapplication sh -c "mkdir -p data && chmod 755 data"
docker exec -it webapplication sh -c "cd assets/composer && composer update &&  composer install"
docker exec -it sensorcontroller sh -c "cd assets/composer && composer update &&  composer install"
