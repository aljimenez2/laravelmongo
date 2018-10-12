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


## Getting Started
To see the page please, use this address in your browser
```
URL 192.168.99.100
PORT 8100

192.168.99.100:8100
```

### Prerequisites

Docker install on machine.

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Laravel](https://laravel.com/docs/5.7) 
* [MongoDB](https://www.mongodb.com/) 

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Alejandro Jimenez** 


