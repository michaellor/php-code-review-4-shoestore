#Hair Salon Database
####PHP Database Basics Code Review for Epicodus, 02.26.2016

###by Michael Lor

##Description

This is a website that allows a user to add and remove Stylists to a list. For each Stylist, there is the option to add and remove Clients. This is achieved by utilizing a mysql database to store and retrieve data.

##Setup
1) Clone this repository to local drive.

2) From the command line, we'll use phpMyAdmin by executing the following:

    apachectl

3) Now open up a browser window and go to http://localhost:8080/phpmyadmin

4) Input the word 'root' for username and password.

5) Using phpMyAdmin, import the hair_salon.sql.zip included in the root directory of this project.

6) Start mysql by executing the following from the command line:

    mysql.server start

7) Next, execute the following from the command line:

    mysql -uroot -proot

8) On the command line, execute the following code to use this project database.

    USE shoes

* NOTE: If you were unable to import the database, please use the following commands from the mysql command line in order to create the database for use:

    CREATE DATABASE shoes;

    USE shoes;

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
