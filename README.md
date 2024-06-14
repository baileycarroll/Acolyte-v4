# Gathering W.I.N.D. (Witches In Nevada Desert)

This was the first version of Acolyte that was ever conceptualized for a client. I knew enough about programming and web development to make the things, however I didn't know any standards, conventions, or caveats to protecting the system. The styling is basic using Bootstrap 4 and custom CSS.

This release is essentially v1.0.0 and while I keep it as a great starting point, I could have done better.

### Note:
This repository was updated to run in docker, and I had to get the DB structure from the source files as I didn't save the initial SQL... The changes made to this are very small in terms of what was changed from the original code and this version.

## Setup
1. Clone the repository
2. From the root directory copy .env.example to .env and fill in. (See example changes below.)
3. From the root directory run the following: `docker-compose --env-file ./src/.env up -d`
4. Open an ssh connection to the app container and run the following command.
   
   + `composer install && php artisan migrate --seed && php artisan key:generate`

5. Now you can login and view the application with the following credentials:

   + **Username:** acolyte
   + **Password:** \[SUPPORT_PASSWORD\] as defined in your .env file.  

6. The installation is extremely bare bones and the Digital Ocean spaces information will no longer work, so class video uploads / etc will no longer work. However for demonstrating the UI this will suffice. 

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