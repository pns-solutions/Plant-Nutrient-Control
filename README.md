# This is out main Project with all features!

## Installation
### 1. Login to your server (e.g.raspberry-pi)
```shell
ssh USERNAME@XXX.XXX.XXX.XX
```
### 2. Update apt-get
```shell
sudo apt-get update
```
### 3. Install Git:
```shell
sudo apt install git-all -y
```
### 4. Clone repo to your raspberry pi (or whatever you want to use)
you can use SSH (preferred) or HTTPS
#### SSH: 
```shell
git clone git@github.com:pns-solutions/Plant-Nutrient-Control.git
```
if you don't have an ssh-key, follow the guide in the additional information section
    
#### HTTPS: 
```shell
git clone https://github.com/pns-solutions/Plant-Nutrient-Control.git
```

### 5. Go to the cloned repository (on your server)
```shell
cd Plant-Nutrient-Control
```

### 6. Run the script
```shell
chmod +x ./fresh-install.sh
```

```shell
./fresh-install.sh
```
  if there were not problems, your system should run now. Otherwise, use the manuel installation in the **additional information** section

___ 

## Locations
Your application should now be accessible from the following locations:
- Application: `192.168.xxx.xx:8080`
- Elasticsearch: `192.168.xxx.xx:9200` | Will take a few minutes to start after docker compose completes successfully.
- Grafana: `192.168.xxx.xx:3030` | admin:admin (initial)
- NodeRed: `192.168.xxx.xx:1880`
- Sensorcontroller: `192.168.xxx.xx:49153`
- MQTT: `192.168.xxx.xx:8883` | Does not display HTTPS results. Try a NodeRed flow.


## DataFaker
The DataFaker is implemented as a nodered-flow.
#### Import: 
- menu
- import
- local
- select: dataFaker.json
- import

___ 

## Additional Information

> ### Manuel installation without script
> install docker
> ```shell
> curl -fsSL https://get.docker.com -o get-docker.sh
> ```
> 
> ```shell
> sudo sh get-docker.sh
> ```
> adding your user to the docker group
> ```shell
> sudo usermod -a -G docker $USER
> ```
> 
>restart pi:
>```shell
>sudo reboot
>```
>
>install docker compose
>```shell
>sudo apt-get install docker-compose
>```
>
>start docker
>```shell
>sudo systemctl enable docker # Auto-start on boot
>```
>
>```shell
>sudo systemctl start docker # Start right now
>```
>
>go to the cloned repository (on your server)
>```shell
>cd /DockerSetup
>```
>
>run the following commands:
>```shell
>docker-compose build && docker-compose up -d
>```
>```shell
>docker exec -it webapplication sh -c "mkdir -p logs && chmod 755 logs"
>```
>
>```shell
>docker exec -it webapplication sh -c "cd assets/composer && composer update &&  composer install"
>```
>
>```shell
>docker exec -it sensorcontroller sh -c "cd assets/composer && composer update &&  composer install"
>```





  
### Generate SHH-Key
> ```shell
> ssh-keygen -t rsa
> ```
> - enter
> - password
> - repeat password
> - get ssh key:   
> ```shell
> cat ~/.ssh/id_rsa.pub  
> ```
> - copy key to clipboard
> - go to GitHub
> - you profile icon -> setting
> - SSH and GPG keys
> - new SSH key
> - add the key from ssh


### Other commands
find port blocking process: 
```shell
sudo lsof -i -P -n | grep 1880
```

kill process: 
```shell
sudo kill 447
```

### Docker
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
copy to current path

#### restart docker
TLS handshake timeout was an error. Restart docker:

```shell
sudo systemctl restart docker
```


### ocker compose
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

```shell
sudo poweroff
```

#### Restart
```shell
sudo reboot
```
