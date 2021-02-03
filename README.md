CONTENTS OF THIS FILE
---------------------

* Introduction
* Technical requirements
* Installation
* Sites


INTRODUCTION
------------

Implement a microblog that has a simple but effective admin panel where the 
admin users can log in and publish posts.

TECHNICAL REQUIREMENTS
------------

Docker Containers

PHP: 7.4

Mysql: 5.7.28

Slim Framework 4 - Backend API

React - Frontend

Server #1: Nginx (localhost:8083) - backend

Server #2: Nginx (localhost:8084) - frontend

Bootstrap



INSTALLATION
------------
git clone https://github.com/KMTsvetanov/slim-with-react.git

----------------

cd slim-with-react

git checkout integration

----------------

docker-compose build

docker-compose up -d

----------------

docker cp database.sql mysql3:/database.sql;

docker exec mysql3 /bin/sh -c 'mysql -u root -proot DBname </database.sql'

----------------

docker exec -it slim-with-react_phpfpm_1 bash

cd /var/www/web

-(optional if composer update does not work) composer config --global disable-tls true

-(optional if composer update does not work) composer config --global secure-http false

-(optional if composer update does not work) composer config --global repo.packagist composer http://packagist.org

composer update

cd /var/www/web2

npm install

npm run build

SITES
------------
Backend SLIM 4 url ----- localhost:8083

Frontend React url ------ localhost:8084