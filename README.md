# Diary

## Description

A project to handle a simple diary

## Getting Started

### Dependencies

* Docker
* Node

### Installing

* Download the project

* Copy the backend/.env.example to backend/.env 
  * You can keep it as is or change the database credentials both here and in the docker-compose file

* Run "docker-compose up --build" in the project folder in terminal
* Run "docker exec -it [laravel container id] bash" in a terminal
* RUN php artisan migrate to create the database tables
  * maybe you need to run the migration local, change the DB_HOST in .env to 127.0.0.1 then and after the migration you need to change back
* Go to the frontend folder and run first npm install, then npm run dev (this will be dockerized, but I ran in to problems but does not give so much value to be run in docker anyway) 

### Executing program

* Visit localhost in a browser for visit the homepage
* Open localhost:3000 and start write a diary
* localhost:3306 for access the database with db tool or http://localhost:8081/ for phpmyadmin

## Version History

* 0.1
    * Environment skeleton created 
