#! /bin/bash
# Installing Necessary Dependencies.
apt-get install apache2 libapache2-mod-php php php-common php-xml php-gd php-opcache php-mbstring php-tokenizer php-json php-bcmath php-zip unzip nodejs curl php-curl -y

# Get Repo From User
echo "Hello! Welcome to the Acolyte Setup Utility! Please provide the name of the website that will be hosting Acolyte:"
read website
echo "Making Directory..."
sudo mkdir /var/www/$website
echo "Please provide the address of the repo you are cloning Acolyte from:"
read repo
echo "Cloning Repo..."
sudo chown -R $USER:www-data /var/www/$website
git clone $repo /var/www/$website/
echo "Installing necessary dependencies..."
# Installing Composer
curl -sS https://getcomposer.org/installer | php;
# Moving composer to system path
sudo mv composer.phar /usr/local/bin/composer;
# Enabling apache2 re-write module
sudo a2enmod rewrite;
# Update php.ini
sudo sed -i '/\<file_uploads\>/c\file_uploads=On' /etc/php/8.1/apache2/php.ini;
sudo sed -i '/max_file_uploads/c\max_file_uploads=20' /etc/php/8.1/apache2/php.ini;
sudo sed -i '/post_max_size/c\post_max_size=2G' /etc/php/8.1/apache2/php.ini;
sudo sed -i '/upload_max_filesize/c\upload_max_filesize=1.5G' /etc/php/8.1/apache2/php.ini;
sudo sed -i '/max_execution_time/c\max_execution_time=30000' /etc/php/8.1/apache2/php.ini;
sudo sed -i '/max_input_time/c\max_input_time=600' /etc/php/8.1/apache2/php.ini;
sudo sed -i '/memory_limit/c\memory_limit=2G' /etc/php/8.1/apache2/php.ini;
# Creating Apache config files
sudo cat << EOF > /etc/apache2/sites-available/$website.conf
<VirtualHost *:80>
    ServerName $website
    ServerAlias $website
    ServerAdmin helpdesk@pattisparadoxes.com
    DocumentRoot /var/www/$website/public
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
RewriteEngine on
RewriteCond %{SERVER_NAME} =www.$website [OR]
RewriteCond %{SERVER_NAME} =$website
RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>
EOF
sudo a2ensite $website.conf
# Restart Apache2 to Apply Changes
sudo systemctl restart apache2;
cd /var/www/$website
# Install Dependencies
composer install;
npm install --production;
echo "Changing permissions as necessary..."
chown -R www-data:www-data /var/www/$website
chmod -R 755 /var/www/$website/storage
chmod -R 755 /var/www/$website/bootstrap/cache
chown -R www-data:www-data /var/www/$website/storage
chown -R www-data:www-data /var/www/$website/bootstrap/cache
cp .env.example .env
echo "-----------------------------------------------------------------------------------------------------------------------------"
echo ""
echo ""
echo "Please enter the application name:"
read app_name
echo ""
echo "Please enter the application environment:"
read app_env
echo ""
echo "Please enter the application url:"
read app_url
echo ""
echo "Please enter the database connection type:"
read db_connection
echo ""
echo "Please enter the database host:"
read db_host
echo ""
echo "Please enter the database port:"
read db_port
echo ""
echo "Please enter the database name:"
read db_database
echo ""
echo "Please enter the database username:"
read db_username
echo ""
echo "Please enter the database password:"
read db_password
echo ""
echo "Please enter the Digital Ocean Spaces Key:"
read do_space_key
echo ""
echo "Please enter the Digital Ocean Spaces Secret:"
read do_space_secret
echo ""
echo "Please enter the Digital Ocean Spaces Endpoint:"
read do_space_endpoint
echo ""
echo "Please enter the Digital Ocean Spaces Bucket:"
read do_space_bucket
echo ""
echo "Please enter the Digital Ocean Spaces Region:"
read do_space_region
echo ""
echo "Please enter the Google Calendar API Key:"
read google_calendar_api_key
echo ""
echo "Please enter the Support Password:"
read support_password
echo ""
echo "-----------------------------------------------------------------------------------------------------------------------------"
echo ""
echo "Setting up application environment..."
sudo sed -i "/APP_NAME/c\APP_NAME=$app_name" .env;
sudo sed -i "/APP_ENV/c\APP_ENV=$app_env" .env;
if [ "$app_env" = "production" ]
then
    sed -i "/APP_DEBUG/c\APP_DEBUG=false" .env;
else
    sed -i "/APP_DEBUG/c\APP_DEBUG=true" .env;
fi
sudo sed -i "/APP_URL/c\APP_URL=$app_url" .env;
sudo sed -i "/DB_CONNECTION/c\DB_CONNECTION=$db_connection" .env;
sudo sed -i "/DB_HOST/c\DB_HOST=$db_host" .env;
sudo sed -i "/DB_PORT/c\DB_PORT=$db_port" .env;
sudo sed -i "/DB_DATABASE/c\DB_DATABASE=$db_database" .env;
sudo sed -i "/DB_USERNAME/c\DB_USERNAME=$db_username" .env;
sudo sed -i "/DB_PASSWORD/c\DB_PASSWORD=$db_password" .env;
sudo sed -i "/FILESYSTEM_DISK/c\FILESYSTEM_DISK=digital_ocean" .env;
sudo sed -i "/DO_SPACES_KEY/c\DO_SPACES_KEY=$do_space_key" .env;
sudo sed -i "/DO_SPACES_SECRET/c\DO_SPACES_SECRET=$do_space_secret" .env;
sudo sed -i "/DO_SPACES_ENDPOINT/c\DO_SPACES_ENDPOINT=$do_space_endpoint" .env;
sudo sed -i "/DO_SPACES_BUCKET/c\DO_SPACES_BUCKET=$do_space_bucket" .env;
sudo sed -i "/DO_SPACES_REGION/c\DO_SPACES_REGION=$do_space_region" .env;
sudo sed -i "/GOOGLE_CALENDAR_API_KEY/c\GOOGLE_CALENDAR_API_KEY=$google_calendar_api_key" .env;
sudo sed -i "/SUPPORT_PASSWORD/c\SUPPORT_PASSWORD=$support_password" .env;
php artisan key:generate

