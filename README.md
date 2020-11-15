## Setup

Open up Terminal and run these commands:
```
cd path/to/project && cd laradock && cp env-example .env && docker-compose up -d nginx mysql phpmyadmin && docker-compose exec workspace bash
```

Open up Chrome and enter http://localhost:8001 on the address bar to access phpMyAdmin. Credentials are below. From here, create a database corresponding to the value of the DB_DATABASE property in your root folder's .env file.
```
Server: mysql
Username: root
Password: root
```

Back to your Terminal, run the migrations (make sure you're still "bashed" in to workspace):
```
php artisan migrate
```
