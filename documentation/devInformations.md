# This are some commands that could help you while developing the application

## Clean application
**Caution: This will delete all volumes and containers. All setting for grafana, and nodered will be removed**

```shell
> ```shell
> docker-compose down
> ```
> 
> ```shell
> docker rm $(docker ps -a -q)
> ```
> 
> ```shell
> docker volume rm $(docker volume ls -q)
> ```
> 
> ```shell
> ./scripts/build-docker.sh
> ```




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
