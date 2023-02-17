# e-commerce
First clone the project :
```
https://github.com/KhaledQasim/e-commerce
```
# Setting up the project.

Open a terminal in the project folder and run (this will take a while):
```
composer install && composer update
```
```
npm install && npm run build
```
Open phpmyadmin and create a new database called "homestead".

Then create a .env file and copy everything from the .env.example file and fill fields with the correct info being:

APP_NAME=Jewelz

APP_URL=https://yourHostingPath/e-commerce/public    //https://210169438.cs2410-web01pvm.aston.ac.uk/Team-33/public

DB_DATABASE=homestead

Then save the file.

For (APP_KEY=) value , you must run the command in terminal it will autofill the APP_KEY feild in the .env file:
```
php artisan key:generate
```

Run this to fix Voyager package:
```
php artisan voyager:install
```

Then create the admin account for the voyager admin pannel, the password will be asked for in the terminal and the email is in the command (admin@admin.com):
```
php artisan voyager:admin admin@admin.com --create
```

Then go to the Voyager admin pannel by placing admin in the url as such:

https://yourHostingPath/e-commerce/public/admin

Login with your recently created admin account.

That is it , Happy coding!
