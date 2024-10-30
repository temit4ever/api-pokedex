## About the App

Simple Laravel web application to connect to the PokeAPI

## How to use the app
- Clone the project
- cd into the project folder.
- Copy the `.env.example` to `.env`
- run composer install && npm install
- You also have two options here, you can either use docker or php artisan to set up the server

## For Docker - Make sure you have docker engine running
- `docker-compose up -d --build`
- `docker ps --all` To make sure all containers are running (APP_SERVER && APP_DBSERVER)
- `docker exec -it APP_SERVER bash` to ssh into docker
- `php artisan migrate` to run the migration for the tables
- `npm run dev` to start up the frontend server

## For Artisan Command
- After bullet point 4 - you can run `php artisan serve`

- You can configure the host path to use the host name `http://pokemon-app:8080` provided in the env.example file or change back to localhost in the .env.example file to use `127.0.0.1:8080`

