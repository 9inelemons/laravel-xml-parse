# Laravel XML Parse Project
This projects parse xml data from file and fills data in PostgreSQL

## Requirements
- Docker
- Docker-compose

## Run
`cp .env.example .env` and set env variables
<br>
``docker-compose up`` to run containers
<br>
``docker exec -it <APP_NAME>-app /bin/sh`` to open shell in laravel container (see APP_NAME in .env)
<br>
``php artisan migrate:fresh`` to create DB tables
<br>
``php artisan parse:tradein`` to parse XML data
<br>
``php artisan update:products`` to update products data from external API
