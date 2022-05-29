# DockerSetup

## locations
- Application: `192.168.xxx.xx:8080`
- Elasticsearch: `192.168.xxx.xx:9200` | Will take a few minutes to start after docker compose completes successfully.
- Grafana: `192.168.xxx.xx:3030` | admin:admin (initial)
- NodeRed: `192.168.xxx.xx:1880`
- MQTT: `192.168.xxx.xx:8883` | Does not display HTTPS results. Try a NodeRed flow.

## ssh
copy ssh key to clipboard: `cat ~/.ssh/id_rsa.pub`


## elasticsearch setup

https://hub.docker.com/r/comworkio/elasticsearch

https://gitlab.comwork.io/oss/elasticstack/elasticstack-arm

## installation unserer anwendung
https://getcomposer.org/


## other commands
find port blocking process: `sudo lsof -i -P -n | grep 1880`

kill process: `sudo kill 447`

## docker
Stop all the containers
`docker stop $(docker ps -a -q)`

Remove all the containers
`docker rm $(docker ps -a -q)`

combined
`docker stop $(docker ps -a -q) && rm $(docker ps -a -q)`


## docker compose

`docker-compose up`

`docker-compose up -d`

`docker-compose restart`

## complete restart after change


```shell
sudo git pull && docker stop $(docker ps -a -q) && docker rm $(docker ps -a -q) && docker-compose up -d
```

