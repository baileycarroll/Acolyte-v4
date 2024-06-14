# Acolyte REALMS


# Intro

Alrighty now we are really stepping into a bigger world! This is version 4.0.0 of Acolyte R.E.A.L.M.S., and largely one of my biggest achievements. I took everything that I learned over the years and compounded it into this platform. Remembering the blunders that were made in v3.0.0 and the missteps in v2.4.0 and below I was able to turn my MVP into something that was useable. This version of Acolyte was actually licensed out to a client of mine and was used until January 2024. 

## Setup
Since my skills have grown I have learned a variety of ways to improve my deployment methods and now everything is deployable via Docker for easy replication and viewing. I learned from many mistakes that were made and even kept the migrations and base DB seeder included and use the .env file to keep passwords stored and secured.

1. Clone the repository
2. From the root directory copy .env.example to .env and fill in. (See example changes below.)
3. From the root directory run the following: `docker-compose --env-file ./src/.env up -d`
4. Open an ssh connection to the app container and run the following command.
   
   + `composer install`

5. Now edit the DB_USERNAME in .env to root.
6. Now open an ssh connection to the app container again and run the following command.

   + `php artisan migrate --seed`
7. Edit the DB_USERNAME in .env back to the original value
8. Open an ssh connection to the app container one more time and run the following:

   + `php artisan key:generate`
9. Now in src/storage/logs delete the laravel.log file.

10. Now you can login and view the application with the following credentials:

   + **Username:** acolyte
   + **Password:** \[SUPPORT_PASSWORD\] as defined in your .env file.  

11. The installation is extremely bare bones and the Digital Ocean spaces information will no longer work, so class video uploads / etc will no longer work. However for demonstrating the UI this will suffice. 

## Take Down
Simply run `docker-compose --env-file ./src/.env down`.

## ENV Example
```dotenv
# Project Name for Docker
COMPOSE_PROJECT_NAME="acolyte-v1_0_0"

# Laravel Configs
APP_NAME="Acolyte R.E.A.L.M.S."
APP_ENV=local
APP_KEY=**********
APP_DEBUG=true
APP_URL=http://acolyte.test

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=acolyte
DB_USERNAME=acolyte
DB_ROOT_PASSWORD=**********
DB_PASSWORD=**********

GOOGLE_CALENDAR_API_KEY=
SUPPORT_PASSWORD=**********
```