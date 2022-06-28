#!/bin/sh

#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "* * * * * docker exec -d  webapplication sh -c 'cd controller && php sensor_controller.php'" > mycron
#install new cron file
crontab mycron
rm mycron