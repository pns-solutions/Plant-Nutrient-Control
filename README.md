# This is out main Project with all features!

### installation
- login to your server (e.g.raspberry-pi) 
  - e.g.: 
  ```shell
  ssh USERNAME@XXX.XXX.XXX.XX
  ```
- 
  ```shell
  sudo apt-get update
  ```
- (optional) install git:
  ```shell
  sudo apt install git-all -y
  ```
- clone repo to your raspberry pi (or whatever you want to use)
  - SSH: 
    ```shell
    git clone git@github.com:pns-solutions/DockerSetup.git
    ```
    - (optional) generate SHH-Key
      ```shell
      ssh-keygen -t rsa
      ```
      - enter
      - password
      - repeat password
      - get ssh key:   
      ```shell
      cat ~/.ssh/id_rsa.pub  
      ```
      - copy key to clipboard
      - go to GitHub
      - you profile icon -> setting
      - SSH and GPG keys
      - new SSH key
      - add the key from ssh
  - HTTPS: 
    ```shell
    git clone https://github.com/pns-solutions/DockerSetup.git
    ```

- install docker
  ```shell
  curl -fsSL https://get.docker.com -o get-docker.sh
  ```
  
  ```shell
  sudo sh get-docker.sh
  ```
- (optional) adding your user to the docker group
  ```shell
  sudo usermod -a -G docker $USER
  ```
  
  restart pi: 
  ```shell
  sudo reboot
  ```
  
- (optional) install docker compose
  ```shell
  sudo apt-get install docker-compose
  ```
  
- (optional) start docker
  ```shell
  sudo systemctl enable docker # Auto-start on boot
  ```
  
  ```shell
  sudo systemctl start docker # Start right now
  ```
  
- go to the cloned repository (on your server)
  ```shell
  cd /DockerSetup
  ```
  
- run the following commands:
  ```shell
  docker-compose build && docker-compose up -d
  ```
  
  ```shell
  docker-compose exec application composer update && docker-compose exec application composer install
  ```
  
  ```shell
  docker-compose exec sensorcontroller composer update && docker-compose exec sensorcontroller composer install
  ```

  
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
```shell
sudo lsof -i -P -n | grep 1880
```

kill process: 
```shell
sudo kill 447
```

### docker
#### Stop all the containers
```shell
docker stop $(docker ps -a -q)
```

#### Remove all the containers
```shell
docker rm $(docker ps -a -q)
```

#### combined
```shell
docker stop $(docker ps -a -q) && rm $(docker ps -a -q)
```

#### open docker container as root user
```shell
docker exec -u root -t -i <CONTAINER_NAME/ID> /bin/bash
```

#### copy files from docker to host
```shell
docker cp <containerId>:/file/path/within/container /host/path/target
```

```shell
docker cp 85d0da39ae31:/etc/grafana/grafana.ini .
``` 
/ copy to current path

#### restart docker
TLS handshake timeout was an error. Restart docker:

```shell
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
