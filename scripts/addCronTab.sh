#!/bin/sh

docker exec -d webapplication sh -c "cd scripts && chmod 755 restart.sh"

#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "* * * * * docker exec webapplication /scipts/restart.sh" >> mycron
#install new cron file
crontab mycron
rm mycron