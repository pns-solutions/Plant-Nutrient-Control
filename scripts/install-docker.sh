#!/bin/sh
apt-get update  # To get the latest package list

#install docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

#adding your user to the docker group
sudo usermod -a -G docker "$USER"

#restart pi:
sudo reboot
