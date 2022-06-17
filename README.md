# This is out main Project with all features!

### installation
- login to your server (e.g.raspberry-pi) 
  - e.g.: ```ssh USERNAME@XXX.XXX.XXX.XX```
- `sudo apt-get update`
- (optional) install git: `sudo apt install git-all -y`
- clone repo to your raspberry pi (or whatever you want to use)
  - SSH: `git clone git@github.com:pns-solutions/DockerSetup.git`
    - (optional) generate SHH-Key
      - `ssh-keygen -t rsa`
      - enter
      - password
      - repeat password
      - get ssh key: `cat ~/.ssh/id_rsa.pub`
      - copy key to clipboard
      - go to GitHub
      - you profile icon -> setting
      - SSH and GPG keys
      - new SSH key
      - add the key from ssh
  - HTTPS: `git clone https://github.com/pns-solutions/DockerSetup.git`

- install docker
  - `curl -fsSL https://get.docker.com -o get-docker.sh`
  - `sudo sh get-docker.sh`
- (optional) adding your user to the docker group
  - `sudo usermod -a -G docker $USER`
  - restart pi: `sudo reboot`
- (optional) install docker compose
  - `sudo apt-get install docker-compose`
- (optional) start docker
  - `sudo systemctl enable docker # Auto-start on boot`
  - `sudo systemctl start docker # Start right now`
- go to the cloned repository (on your server)
  - `cd /DockerSetup`
- run the following commands:
  - `docker-compose build && docker-compose up -d`
  - `docker-compose exec application composer update && docker-compose exec application composer install`
  - `docker-compose exec sensorcontroller composer update && docker-compose exec sensorcontroller composer install`

  
## DataFaker
The DataFaker is implemented as a nodered-flow.
#### Import: 
- menu
- import
- local
- select: dataFaker.json
- import


## locations
- Application: `192.168.xxx.xx:8080`
- Elasticsearch: `192.168.xxx.xx:9200` | Will take a few minutes to start after docker compose completes successfully.
- Grafana: `192.168.xxx.xx:3030` | admin:admin (initial)
- NodeRed: `192.168.xxx.xx:1880`
- Sensorcontroller: `192.168.xxx.xx:49153`
- MQTT: `192.168.xxx.xx:8883` | Does not display HTTPS results. Try a NodeRed flow.

## other informations
### elasticsearch setup

https://hub.docker.com/r/comworkio/elasticsearch

https://gitlab.comwork.io/oss/elasticstack/elasticstack-arm

### installation unserer anwendung
https://getcomposer.org/


### other commands
find port blocking process: 
```
sudo lsof -i -P -n | grep 1880
```

kill process: 
```
sudo kill 447
```

### docker
#### Stop all the containers
```
docker stop $(docker ps -a -q)
```

#### Remove all the containers
```
docker rm $(docker ps -a -q)
```

#### combined
```
docker stop $(docker ps -a -q) && rm $(docker ps -a -q)
```

#### open docker container as root user
```
docker exec -u root -t -i <CONTAINER_NAME/ID> /bin/bash
```

#### copy files from docker to host
```
docker cp <containerId>:/file/path/within/container /host/path/target
```

```
docker cp 85d0da39ae31:/etc/grafana/grafana.ini .
``` 
/ copy to current path

#### restart docker
TLS handshake timeout was an error. Restart docker:

```
sudo systemctl restart docker
```


### docker compose
```shell
docker-compose up
```
```shell
docker-compose up -d
```

```shell
docker-compose restart
```

```shell
docker-compose up -d --force-recreate && docker-compose logs -f
```
### complete restart after change


```shell
sudo git pull && docker stop $(docker ps -a -q) && docker rm $(docker ps -a -q) && docker-compose up -d
```

### Raspberry
#### Shutdown
`sudo poweroff`

#### Restart
`sudo reboot`

- `docker-compose exec sensorcontroller composer install && docker-compose exec sensorcontroller composer update`
