#!/bin/sh
docker-compose up -d --force-recreate && docker-compose logs
docker exec -d webapplication sh -c "cd scripts && chmod 755 restartSensorController.sh && ./restartSensorController.sh"