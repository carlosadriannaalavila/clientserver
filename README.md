# clientserver
ClientServer_educational_example

--------------------
Content
--------------------
I.- Team Members
0.- Programming Language 
1.- Introduction
2.- Objectives
3.- File Structure
4.- Installation
5.- Further actions
6.- Running & use
7.- Conclusions

--------------------
I.- Team Members
--------------------

- Yolanda Meredith García Molina
- Juan Manuel Martínez Martinéz
- Carlos Adrián Naal Avila

- Country: México
- City: Zacatecas
- State: Zacatecas

--------------------
0.- Programming Language
--------------------

# PHP

--------------------
1.- Introduction
--------------------

ClientServer_educational_example

Focus in the developing of a non-common way to focus in the Computing Distributed Client-Server paradigm, cause almost every book tries to explain everything in graphics and examples in pseudo-code, here is a practical application of the common in a non-common way.

This little proyect takes a step further from the concept and applies all the concepts into a real-life practice but, What it does?

First of all a Client-Server paradigm focuses in the principles of cause-effect: "Clients makes requests and Servers responds that requests with new information afther some process".

This ClientServer_educational_example uses that focus in the modification and constructions of a marketplace and a little webservice, making the Client-Server more entendible from different perspectives.

--------------------
2.- Objectives
--------------------

This example focuses on the following objectives:

-Installing a marketplace on PHP language.
-Configure the marketplace with the basic data.
-Add some products to the database.
-Modify the default behaviour of the marketplace.
-Modify the database and add a table to key track o the "Key".
-Construction of a webservice that access to a database to retrieve a "Key" which is a String to unlock a series of pdf files.
-Integrate both parts of the proyect.

Overall Objective:

-Explain with two kind of examples the interaction of the client-server paradigm.
-Give a basic example of the applications of client-server paradigm.

--------------------
3.- File Structure
--------------------

root
-prestashop_db_backup
	-1441896642-30963f29.sql.bz2
-web_platform
	-GetFileController.php
	-GetFileControllerOverride.php
	-MySQLOverride.php
-webservice
	-css
		-cssestilo.css
	-index.html
	-vistas
		-obtenerclave.php

--------------------
4.- Installation
--------------------

This installation is only to developers on simple platforms, so it doesn't need complex deploy configurations, it's made with the simple idea of make the user to make use of the example and if it wants to modify according their software and hardware especifications.

Installations Steps:

- Install an Apache Full Distribution package (such as xamp, mamp, etc.).
- Install prestashop following the instructions of this link http://doc.prestashop.com/display/PS16/Setting+Up+Your+Local+Development+Environment (recommended). --NOTE REMEMBER SAVE THE URLs OF YOUR FRONT-OFFICE AND YOUR BACK-OFFICE INDICATED AT THE END OF THE INSTALLATION.
- After Install shutdown your MAMP/XAMP and configure your Time Zone in the config folder of your current Apache (usually you do this dependending on your distribution of apache in the "MAMP or XAMP"->conf->"your current php distribution php5.6.10 fro example").
- Go to your xamp, mamp, etc. Folder: "htdocs"->prestashop->controllers->front and backup your "GetFileControll.php" (copy to another folder, just don't forget where do you keep it).
- Go to your phpmyadmin an add the next sql sentence: ```CREATE TABLE `prestashop`.`ps_webservice` (`reference` VARCHAR(15) NOT NULL,`id_customer` VARCHAR(45) NULL, `key` VARCHAR(45) NULL DEFAULT NULL, `download_date` VARCHAR(45) NULL DEFAULT NULL, PRIMARY KEY (`reference`));```
- Delete file "class_index.php" located on "htdocs"->prestashop->cache.
- Copy the folder webservice in your "htdocs" folder.

--------------------
5.- Further actions
--------------------

- Modify variables from PHP file "obtenerclave.php" accord your server configurations
	-```$server= "yourserver and port";```
	-```$user= "your user";```
	-```$pwd="your password";```
- Save the webservice modifications.

--------------------
6.- Running & use
--------------------

- With your MAMP/XAMP distribution just open your prestashop url for customers normally is http://"server:port"/prestashop
- Register an user and finally purchase the digital product you downloaded.
- After that, two mail will go to your inbox in your email addres especified in the registry if you used a check payment method you must go to your back-office go to Orders->Orders->"Select the order and upate the state of your purchase to Payment Accepted".
- There will be another pair of mails, one of the contains the link to your file (you must download your file).
- Click the link "Servicio de llaves".
- Once in the webpage you must introduce your username and your Reference, wich is in the mail.

--------------------
7.- Conclusions
--------------------

The process is rather simple but it's a very common behaviour in the internet, an example of use is the key service of Microsoft Office 365 which you download but to used it you need your key to activate it, the use of web pages, webservices, forms and purchase process makes this example a very actual example of the interaction between a Client wich makes requests and a Server that responses in consequence.