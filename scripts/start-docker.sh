#!/bin/sh
#install docker compose
sudo apt-get install docker-compose

# start docker
sudo systemctl enable docker # Auto-start on boot
sudo systemctl start docker # Start right now