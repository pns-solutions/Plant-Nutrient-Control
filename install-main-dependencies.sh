#!/bin/sh
apt-get update  # To get the latest package lists
apt-get install git-all -y

#install docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

#adding your user to the docker group
sudo usermod -a -G docker "$USER"

#TODO: hier muss das Script ggf getrennt werden
#restart pi:
#sudo reboot

#install docker compose
sudo apt-get install docker-compose

# start docker
sudo systemctl enable docker # Auto-start on boot
sudo systemctl start docker # Start right now