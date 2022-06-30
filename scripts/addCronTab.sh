#!/bin/sh

#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "0 * * * * docker exec -d  webapplication sh -c 'cd scripts && ./restartControllers.sh'" > mycron
#install new cron file
crontab mycron
rm mycron