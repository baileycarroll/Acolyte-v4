# Acolyte LMS

This is the second version of Acolyte, after years of growing my skillsets in web development I returned to Acolyte and said: "This is a really cool idea, I want to actually expand upon this and make it better." And so taking all of the knowledge that I gained I did expand upon it and came up with this design. 

Leaving basic PHP, Bootstrap 4, and Custom CSS behind I moved towards using a couple of frameworks to extend my now much greater skillset. In this version I used the following frameworks:

+ Laravel v9.11
+ MDBoostrap 4
+ FontAwesome
+ SaSS

Using those above frameworks I was quickly able to expand upon the concept and get a viable MVP ready, however this was only the start of the journey. I was not as good at backend design and development at the time (let alone frontend) which caused me to make serious design errors that I wouldn't catch until I continued to grow and expand. At that point being far too late to resolve without a major version upgrade.

## Setup at Time of Development (Jan 2021)
Unlike Acolyte v1.0.0 setup for this system is much much easier, there is a shell script that is included that will install all the necessary dependencies on the VPS, and walk you through editing / creating the .env file for the entire program to run. 

## Setup Now (2024)
Since my skills have grown I have learned a variety of ways to improve my deployment methods and now everything is deployable via Docker for easy replication and viewing. I learned from many mistakes that were made and even kept the migrations and base DB seeder included and use the .env file to keep passwords stored and secured.

1. Clone the repository
2. From the root directory fill in the .env file. (See example changes below.)
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