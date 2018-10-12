# User List Laravel + MongoDB + Muuri

This project will let you use a dinamic table with Drag and Drop elements.
You will we capable of Adding, editing and deleting users for the table.

### Installing

First of all, you'll need to build de containers of docker.
Use the next commands

```
docker-compose build
```
when the image are done building, make then a container with
```
docker-compose up -d
```
Next will install composer
```
docker-compose exec web composer install
```

Next laravel wil be needing a [key] so be will generate it. 
```
docker-compose exec web php artisan key:generate
```


## Getting Started
For Windows
To see the page please, use this address in your browser
```
URL 192.168.99.100
PORT 8100

192.168.99.100:8100
```

Other Platforms 
Please check your IP Using 
```
Docker-machine ls 
```
and use the URL 
```
NAME      ACTIVE   DRIVER       STATE     URL                         SWARM   DOCKER        ERRORS
default   *        virtualbox   Running   tcp://192.168.99.100:2376           v18.05.0-ce
testb     -        virtualbox   Running   tcp://192.168.99.101:2376           v18.06.1-ce
```

### Prerequisites

Docker install on machine.

## Error and troubleshooting
If you are not able to save items, please follow this steps:

In case the collection is not initialize run
```
docker exec -it mongodb bash
```
Inside the bash on mongo DB
```
mongo users
db.createCollection('users')
exit
exit
```

## Built With

* [Laravel](https://laravel.com/docs/5.7) 
* [MongoDB](https://www.mongodb.com/) 


## Authors

* **Alejandro Jimenez** 


