<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Cinema API project

## About this app
**The app is about managing movies and movie screening.**

This web application was created in:\
Laravel (backend), Vue.js (frontend)

_**Disclaimer: This application made for learning purposes only.**_

## Features
**You can expect features like:**

- CRUD operations for movies
- CRUD operations for screenings
- Schedule for screenings

## Installation guide
1. Open a terminal
2. Clone this repository
```
git clone https://github.com/nfcrazyhun/cinema-project.git
```
3. `cd` into it
4. Install dependencies
```
composer install
```
5. Copy then rename `.env.example` to `.env`
```
copy .env.example .env
```
6. Generate application key
```
php artisan key:generate
```
7. Create a database
    1. Name: `cinema-project`
    2. (collation: utf8mb4_unicode_ci)
   > Update the database credentials in the `.env` file.
8. Set up database tables (with demo data)
```
php artisan migrate:fresh --seed
```
9. Create symbolic links
```
php artisan storage:link
```
10. Set up VirtualHost for the project (recommended: http://cinema-project.test )
   > Be sure to update the **APP_URL** line in the `.env` file to match your VirtualHost.
11. Build frontend assets
```
npm install
npm run build
```

## API Documentation
The API documentation can be found here: http://cinema-project.test/docs/api

## Note
The project was created using the following software versions:
- PHP 8.3.12
- Laravel Framework 11.27.0
- Vue.js 3.5.11
- Tailwind CSS 3.4.13
- node 20.17.0 *(lts)*
- npm 10.8.2
