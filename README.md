upx
===

A Symfony project created on April 12, 2017, 12:16 am.
Simple REST API for Polls and Answers control.
http://docs.testefrontendupx.apiary.io/ for API endpoints documentation.

Requirements
============
To have the project running you have to make sure your system complies to the following requirement:
- Symfony requirements: http://symfony.com/doc/current/reference/requirements.html
- Composer installed and runninng.

Installation
============

- Run composer install in the project root folder
- Configure the database connection settings, you can leave the other configuration default.
- Run php app/console doctrine:schema:create to prepare database and tables.
- Run php app/console server:start to put the server running
- Server should be accessible through localhost:8000

