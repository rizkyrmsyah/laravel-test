# Laravel Test App

Stack used:
- Laravel 8
- Laravel spatie enum

## Installation Requirements
- PHP 8.0+
- Mysql Database
- Composer installed in your PC

## Installation
- After clone this project run command below for installing project dependency

```bash
composer install
```
- copy `env` file by typing
```bash
cp .env.example .env
```

- Set the database connection and JWT config in `.env`
- Set `MAIN_API_URL` for dashboard api endpoint call (here we use http://127.0.0.1:8000)
- Migrating database by typing 
```bash
php artisan migrate
```

## Running Unit Test
Command promt / terminal in root directory of project, then type
```bash
vendor/bin/phpunit
```

## Usage

1. Import postman collection file in this project root directory to your local postman collection
2. Run the API in local environment by typing
```bash
php artisan serve
```
3. For running dashboard API MUST RUNNING FIRST ! and dashboard must run in different port from API. here we use port 8001 for running the dashboard by typing

```bash
php artisan serve --port=8001
```
