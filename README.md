Subscribe me on "[jQueryTips Fanpage](https://www.facebook.com/jQueryTips)"

# "Dashboard" A CodeIgniter Modified by Tee++; v1.0b

A Framework CodeIgniter Modified integrate everything you need to develop website or RESTful web service.

Easy install 

## Requirements

1. PHP 5.2+
2. [Zend Framework](http://framework.zend.com/download/current/) Installed

## Installation
* Download Zend and add include path in php.ini
* Extract all code into the directory you want
* Config your domain at /application/config/config.php 
* Config the database connection in /application/config/database.php
* Config authentication at /application/config/auth.php
* Import database from the .sql file you'll found at /backup/sql/[name].sql

## What I've done

* Integrate [Modular Extension HMVC](http://codeigniter.com/wiki/Modular_Extensions_-_HMVC)
* Integrate Zend Framework
* Add load utilities (utils)
* Add Util::DB using Zend_Db
* Add REST_Controller to build RESTful Service
* Add [Twig](http://twig.sensiolabs.org) template parser
* Add [Mustache](http://mustache.github.com) template parser
* Add Master Template Concept using [Template Library](http://williamsconcepts.com/ci/codeigniter/libraries/template/reference.html)
* Add i18n for multi language site support
* Add Access Control List using Zend ACL
* Add [Twitter Bootstap](http://twitter.github.com/bootstrap/) to build Core GUI
* Add Authenticate using Zend Auth
* Support Master/Slave database

## What is in the plan? 

* Add Zend Date to control date display
* Add Zend Cache to increase performance
* Hack CI Router to make multiple sub-domain, sub-path, domain for users
* GUI to control language translate
* GUI to control roles and privileges
* GUI to control user

## What I will not promise?

1. Add API Rate Limit control
2. Add API Key to control user access
3. Add CDN structure
4. Add Util:Thumbnail on the fly
5. Add auto detect language and date time
6. Add Util to control JS and CSS
7. Add Less CSS
9. Add Coffee Script

## What is hard to do?

1. Create user guide, manual, document or something like that to make everybody clear what I am doing.