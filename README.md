#Shoe Store Database
####PHP Databases Extended Code Review for Epicodus, 03.04.2016

###by Michael Lor

##Description

This is a website that allows for the addition of Shoe Stores and Shoe Brands. A database is used to create, store, and manage data for the Store class, the Brand class, and a join class between the two. Along with adding stores and brands, stores can also be deleted or updated with a new name. The join class allows for many to many relationships, which ties data between both classes, thus allowing the cross referencing of data between the two classes.

##Setup
1) Clone this repository to local drive.

2) From the command line, we'll use phpMyAdmin by executing the following:

    apachectl

3) Now open up a browser window and go to http://localhost:8080/phpmyadmin

4) Input the word 'root' for username and password.

5) Using phpMyAdmin, import the shoes.sql and shoes_test.sql files included in the root directory of this project.

6) Start mysql by executing the following from the command line:

    mysql.server start

7) Next, execute the following from the command line:

    mysql -uroot -proot

8) On the command line, execute the following code to use this project database.

    USE shoes

* NOTE: If you were unable to import the database, please execute the following commands from the mysql terminal command line in order to create the database for use:

    CREATE DATABASE shoes;

    USE shoes;

    CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255));

    CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR(255));

    CREATE TABLE distributions (id serial PRIMARY KEY, brand_id INT, store_id INT);

9) Install Composer by executing the following code in the command line while in the project root folder:

    composer install

10) From the command line, run the following while in the /web folder:

    php -S localhost:8000

11) To view the webpage, open a web browser and go to http://localhost:8000

##Technologies Used
* Atom
* HTML
* PHP
* Git
* MySQL
* phpMyAdmin
* Terminal
* Composer
* Silex 1.1
* Twig 1.0
* PHPUnit 4.5.*

###License

Copyright (c) 2016 - This software is licensed under the MIT license
