# Gathering W.I.N.D. (Witches In Nevada Desert)

This was the first version of Acolyte that was ever conceptualized for a client. I knew enough about programming and web development to make the things, however I didn't know any standards, conventions, or caveats to protecting the system. The styling is basic using Bootstrap 4 and custom CSS.

This release is essentially v1.0.0 and while I keep it as a great starting point, I could have done better.

### Note:
This repository was updated to run in docker, and I had to get the DB structure from the source files as I didn't save the initial SQL... The changes made to this are very small in terms of what was changed from the original code and this version.

## Setup
1. Clone the repository
2. Copy src/.env.example to src/.env
3. Remove `.gitkeep` from `docker/volumes/mysql`
3. Set all variables in .env (See Example Below)
4. From the root directory run:
   5. `docker-compose --env-file ./src/.env up -d`
6. Now in your browser navigate to [http://localhost:8003](http://localhost:8003)
7. In the database execute the SQL code from the `init.sql` file included. 
16. Now you should be able to login with the username: acolyte and password: acolyte. 
    17. **Login Link:** [http://localhost:8001/users/login.php](http://localhost:8001/users/login.php)

## Takedown
1. Execute the following to take down the containers:
   2. `docker-compose --env-file ./src/.env down`

## Example ENV
```dotenv
# Project Name for Docker
COMPOSE_PROJECT_NAME="gathering_wind"
# DB Connection Settings
DB_HOST=database
DB_PORT=3306
DB_DATABASE=gatheringwind
DB_USERNAME=acolyte
DB_ROOT_PASSWORD=***********
DB_PASSWORD=***********
```