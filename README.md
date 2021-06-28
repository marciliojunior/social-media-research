# Test Project <small>Social Media Research DashBoard</small>

## About the project

This project consists of an experiment using the new version of Laravel (version 8) in conjunction with Bootstrap 4. The created app simulates a visualization panel for posts on social media from lists of people. This panel allows you to query and filter information.

As it is not the focus of the project, the current solution does not access any social media API. It just emulates the information from fake data from a MySQL database.

## Requirements
- PHP >= 7.4
- MySql >= 5.7
- Laravel Framework 8+
- Docker / Docker-compose (In case of Automatically installation)

## Installation
### Manually
Because it is a Laravel project, you must create a `.env` file, and execute the commands below to activate the project:
```sh
composer install
```
*The dev composer requirements are necessary to run the Unit / Feature tests*
```sh
php artisan migrate
```
*Starting to serve the project:*
```sh
php artisan serve
```
### Automatically via Docker-compose
Run the command below and, after installing and activating the containers, the application will be ready to be accessed.
```sh
docker-compose up -d
```
After build / run the images, the application will be available for access through the host address at the port 8000. Ex: `http://<host_address>:8000`
Feel free to change any of the environment variables defined in file `docker-compose.yml` 
## Database Structure
To meet the project specifications, a database was defined with the following structure:
```
| Table persons | Table accounts    | Table social_networks | Table posts | 
| ------------- | ----------------- | --------------------- | ----------- |
| id            | id                | id                    | id          |
| name          | person_id         | name                  | account_id  |
| gender        | social_network_id |                       | post_date   |
| city          |                   |                       | content     |
| state         |                   |                       |             |
```
Other two aditional tables are created to group `persons` in lists:
```
| Table lists | Table lists_persons | 
| ----------- | ------------------- |
| id          | list_id             |
| name        | person_id           |
|             |                     |
|             |                     |
|             |                     |
```
Filling the database with fake data can be done using the command:
```
php artisan db:seed
```
*When executing this command, 100 people will be registered in the database with random number of accounts and posts.*

Additionally, an interface was created that allows filling the database with more details. If the database is not yet filled by the previous operation, this interface will be displayed automatically when accessing the main route of the project. If data already exists, a button indicated by a gear at the top left of the main screen, gives access to the database filling interface.

## Filters

The fields that allow you to filter the data are displayed at the top of the main screen. Additional filters have been included in the `Extra filters` option.

## Tests

Unit and feature tests were created to ensure the following conditions:

- The integrity of the database tables.
- The correct opening of the main view.
- The correct response from the controller responsible for loading the information from the database

There are 7 tests in total, and they are located in the `tests/Unit` and `tests/Feature` folders. 5 unit tests related to the database tables, and 2 feature tests for the operation of opening the main screen and response of the main controller.
Run the tests can be done using the command:
```
./vendor/bin/phpunit
```
## Author
Marcílio Júnior
