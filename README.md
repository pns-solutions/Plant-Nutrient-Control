# This is our main Project with all features!

## Installation on a fresh and clean server (like Raspberry Pi)
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
sudo apt install git -y
```
### 4. Clone repo to your raspberry pi (or whatever you want to use)
you can use SSH (preferred) or HTTPS

#### HTTPS:
- generate Personal Tokem
- https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token
```shell
git clone https://github.com/pns-solutions/Plant-Nutrient-Control.git
```
use the token as password

#### SSH: 
```shell
git clone git@github.com:pns-solutions/Plant-Nutrient-Control.git
```
if you don't have an ssh-key, follow the guide in the additional information section
    


### 5. Go to the cloned repository (on your server)
```shell
cd Plant-Nutrient-Control
```

### 6. Give all scripts the right permissions
```shell
chmod +x ./scripts/install-docker.sh && chmod +x ./scripts/start-docker.sh && chmod +x ./scripts/build-docker.sh
```

### 7. Install docker
After this script is finished, the system will restart. Wait a minute to reconnect via SSH.

```shell
./scripts/install-docker.sh
```

### 8. Start docker
After this script is finished, the system will restart. Wait a minute to reconnect via SSH.

```shell
./scripts/start-docker.sh
```

### 9. Build docker
```shell
./scripts/build-docker.sh
```
If there were not problems, your system should run now. Otherwise, use the manuel installation in the **additional information** section

___ 

## Installation on an already fully set up server (like Raspberry Pi)
make sure you have installed the following dependencies:
- apt-get (update it before you start with the installation)
- git
- docker

### 1. Login to your server (e.g.raspberry-pi)
```shell
ssh USERNAME@XXX.XXX.XXX.XX
```

### 2. Clone repo to your raspberry pi (or whatever you want to use)
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

### 3. Go to the cloned repository (on your server)
```shell
cd Plant-Nutrient-Control
```

### 4. Build docker application
```shell
chmod +x ./scripts/build-docker-application.sh
```
```shell
./scripts/build-docker-application.sh
```
If there were not problems, your system should run now. Otherwise, use the manuel installation in the **additional information** section

___ 

## Locations
Your application should now be accessible from the following locations:
- Application: `192.168.xxx.xx:8080`
- Elasticsearch: `192.168.xxx.xx:9200` | Will take a few minutes to start after docker compose completes successfully.
- Kibana: `192.168.xxx.xx:5601` | Will take a few seconds to start after docker compose completes successfully.
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

___ 

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
