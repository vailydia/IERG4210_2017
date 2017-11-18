# IERG4210_2017
Class Project for IERG4210_2017.

Name:Xi Weiling 
SID:1155096106


## phase1, 2017.09.22：

1) create the laout of main page, refer to index.html;

2) create the product detail page, refer to product.html;

3) design the shopping cart.



## phase2, 2017.10.26：

1) setup a secure server, include to instantiate a Virtual Cloud Machine and apply necessary security configurations;

2) create the database cart.db and admin panel, which allow to manipulate the db;

3) update the index page and product detail page;

4) some functions and features:

Main Page:

![describepic1](https://user-images.githubusercontent.com/30575412/32037366-a134ed36-b9ea-11e7-8372-51ac7ef548ca.png)

![describepic2](https://user-images.githubusercontent.com/30575412/32037376-a5e227cc-b9ea-11e7-88da-fec8ea5cb981.jpg)

Product Detail Page:

![describepic3](https://user-images.githubusercontent.com/30575412/32041244-05ada182-b9f9-11e7-99a5-d20638760f7d.png)



## phase3, 2017.11.1：

1) JS: Dynamically update# the shopping list



## phase4, 2017.11.17：

Domain name: https://secure.s59.ierg4210.ie.cuhk.edu.hk/index.php


1) SQL Injection:
Defence: Always Use prepared statements and parameterized queries. (PDO prepare in PHP);

2) XSS:
Defense: sanitization and validation (both client and server side);

3) Admin Authentication:
Defence: Only admin user can access admin panel;

4) CSRF:
Defence:
Custom http request headers,
Submit a hidden nonce with every form;

5) SSL and Digital Certificate:
Defence: Apply SSL certificate;

6) Session Fixation:
Defence: change session ID after logged.


