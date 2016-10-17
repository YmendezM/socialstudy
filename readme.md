## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

# laravel-5-1
A simple base Laravel 5.1 project using bootstrap.

#Install
1. clone this project in the root directory
2. >> `$ composer install`
3. >> `$ php artisan key:generate`
4. setup your database credentials (using .env file)
5. >> php `$ php artisan migrate`
5. Have fun

#About

- This project uses Bootstrap 3
- implement [barryvdh Laravel debugbar](https://github.com/barryvdh/laravel-dompdf)
- implement [StydeNet blade pagination](https://github.com/StydeNet/blade-pagination)
- Laravel collective 5.1
- en/es language files

#auth

- To register go to path/auth/register
- To login go to path/auth/login
- logout in path/auth/logout

#bootstrap templating

* base layout: /resources/views/app.blade.php
* partials : /resources/views/partials
  * layout
    * navbar.blade.php
    * errors.blade.php
  * auth
    * login.blade.php
    * register.blade.php
* home : /resources/views/home.blade.php

#Passwrod recovery
You can to setup your email credentials to use this feature
by looking the official  [Laravel 5.1 mail documentation](http://laravel.com/docs/5.1/mail).
please specify email and sender name on the .env file
`
SENDER_NAME=
SENDER_ADDRES=
`

#Important! 
Issue report and pull requests are welcome!