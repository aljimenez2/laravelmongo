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
Next laravel wil be needing a [key] so be will generate it. 
```
docker-compose exec web php artisan key:generate
```


## Getting Started
To see the page please, use this address in your browser
```
URL 192.168.99.100
PORT 8100

192.168.99.100:8100
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


