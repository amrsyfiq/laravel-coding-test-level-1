<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

Laravel Live Coding Test - https://github.com/ACN-Coding-Test/laravel-coding-test-level-1

Deployed Application URL - https://laravel-test.amrsyfiq.dev/

## Requirement
1.    PHP 8
2.    PHP Extension (pdo_mysql, exif, mbstring, curl, bcmath, gd, zip)
3.    Mysql 8 / MariaDB 10.5

## Setup
1.    git clone https://github.com/amrsyfiq/laravel-coding-test-level-1.git 
2.    change to the working folder: `cd laravel-coding-test` 
3.    run `composer install`
4.    Duplicate .env.example file. Rename duplicated file to .env
5.    run `php artisan key:generate`
6.    configure .env file
7.    create database & make sure with `Charset=utf8mb4` and `Collation=utf8mb4_unicode_ci`
8.    run `php artisan migrate` or `php artisan db:seed` to load with dummy data
9.    run `php artisan serve` & open http://127.0.0.1:8000/ in the browser, or
10.   run `npm install && run dev` & open http://laravel-test.test/ in the browser

## Setup If Using Docker
1.    git clone https://github.com/amrsyfiq/laravel-coding-test-level-1.git
2.    change to the working folder: `cd laravel-coding-test`
3.    run `docker-compose up -d`
4.    run `docker exec -it laravel-coding-test-php sh` to enter into container
5.    run `composer install`
6.    Duplicate .env.example file. Rename duplicated file to .env
7.    run `php artisan key:generate`
8.    configure .env file
9.    create database & make sure with `Charset=utf8mb4` and `Collation=utf8mb4_unicode_ci`
10.   run `php artisan migrate` or `php artisan db:seed` to load with dummy data
11.   run `php artisan serve` & open http://127.0.0.1:8000/ in the browser, or
12.   run `npm install && run dev` & open http://laravel-test.test/ in the browser
