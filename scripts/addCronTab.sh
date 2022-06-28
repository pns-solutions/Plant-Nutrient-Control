#!/bin/sh

sudo crontab -l > cron_bkp
sudo echo "* * * * * docker exec webapplication /restart.sh >/dev/null 2>&1" >> cron_bkp
sudo crontab cron_bkp
sudo rm cron_bkp