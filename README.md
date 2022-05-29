# DockerSetup

get ssh key to clipboard:
cat ~/.ssh/id_rsa.pub


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


## docker compose

`docker-compose up`

`docker-compose up -d`

`docker-compose restart`
