# Project Title

E-Ticket Concert

## Description

Website application that used to handle E-Ticket concert

## Getting Started

### Dependencies

* Composer
* Php >= 8
* Mysql
* Internet

### Installing
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/master/installation)

Alternative installation is possible without local dependencies relying on [Docker](https://www.docker.com/products/docker-desktop/). 

Clone the repository

    git clone https://github.com/Sleepy4k/laravel-eticket-concert.git

Switch to the repo folder

    cd laravel-eticket-concert

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate hyper link from storage folder to public folder

    php artisan storage:link

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate:fresh --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/Sleepy4k/laravel-eticket-concert.git
    cd laravel-eticket-concert
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan storage:link
    
**Make sure you set the correct database connection information before running the migrations**

    php artisan migrate:fresh --seed
    php artisan serve

## Help

Any advise for common problems or issues.
```
Please create issue for detail information
```

## Authors

Contributors names and contact info

[@Sleepy4k](https://github.com/Sleepy4k)

## Version History

* 1.0.7-alpha
    * update route api
    * change some logic for audit log
    * change main feature logic
    * add cron job for prune expired concert data
    * change resource, form request and model
    * add company concert crud
    * add code documentation and add security checker
* 1.0.0-alpha
    * initial release
    * add main feature
