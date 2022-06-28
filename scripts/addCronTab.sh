#!/bin/sh

#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "* * * * * docker exec webapplication /restart.sh" >> mycron
#install new cron file
crontab mycron
rm mycron