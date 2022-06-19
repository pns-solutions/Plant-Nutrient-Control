#!/bin/sh
docker-compose build && docker-compose up -d
docker exec -it webapplication sh -c "mkdir -p logs && chmod 755 logs"
docker exec -it webapplication sh -c "cd assets/composer && composer update &&  composer install"
docker exec -it webapplication sh -c "cd scripts && chmod 755 restartSensorController.sh && ./restartSensorController.sh"

